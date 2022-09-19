<?php

namespace wipe\inc\v1\role\project_role;

use DB\Base\ObjProjectQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageMaterialTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjStageTechnicTableMap;
use DB\Map\ObjStageWorkTableMap;
use DB\Map\ObjSubprojectTableMap;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use DB\ObjGroupQuery;
use DB\ObjGroupVersionQuery;
use DB\ObjHouseQuery;
use DB\ObjStageMaterialQuery;
use DB\ObjStageMaterialVersionQuery;
use DB\ObjStageQuery;
use DB\ObjStageTechnicQuery;
use DB\ObjStageTechnicVersionQuery;
use DB\ObjStageVersionQuery;
use DB\ObjStageWorkQuery;
use DB\ObjSubprojectQuery;
use DB\ProjectRoleQuery;
use DB\UserRoleQuery;
use DB\UsersQuery;
use DB\VolMaterialQuery;
use DB\VolTechnicQuery;
use DB\VolUnitQuery;
use DB\VolWorkMaterialQuery;
use DB\VolWorkQuery;
use DB\VolWorkTechnicQuery;
use DB\VolWorkVersionQuery;
use Illuminate\Support\Js;
use inc\artemy\v1\json_output\JsonOutput;
use JetBrains\PhpStorm\ArrayShape;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class ProjectRoleSelector
{
    private const ARRAY_KEY_ID = 'id';
    private const ARRAY_KEY_NAME = 'name';
    private const ARRAY_KEY_IS_CRUD = 'isCrud';
    private const ARRAY_KEY_IS_ADMIN = 'isAdmin';
    private const ARRAY_KEY_STATUS = 'status';
    private const ARRAY_KEY_IS_PUBLIC = 'isPublic';
    private const ARRAY_KEY_USER = 'user';
    private const ARRAY_KEY_PRICE = 'price';
    private const ARRAY_KEY_IS_HISTORY = 'isHistory';

    private static ?int $lvl = null;
    private static ?int $objId = null;
    private static ?int $limit = null;
    private static ?int $limitFrom = null;

    /**
     * Массив разрешений пользователей к объекту.
     * Вывод для вкладки "Управление доступом".
     * @param int $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    public static function getUsersCrudForObj(int &$lvl, int &$objId): array
    {
        self::applyForObj($lvl, $objId);

        $users = self::getUsersData();
        $parents = self::getParentsForObj();
        $conditions = self::formingConditionByParents($parents);
        $accesses = self::getProjectRoles($conditions);

        self::mergeCrudByUser($accesses, $users);
        self::formingUsersForObj($users);

        return $users;
    }

    public static function getAuthUserCrudForLvl(int &$lvl, int &$parentId, int &$limit, int &$limitFrom)
    {
        self::applyForLvl($lvl, $parentId, $limit, $limitFrom);

        $userId = 13;
//        $user = self::getAuthUserData()[0];
        $user = self::getUsersData($userId)[0];
        $objs = self::getObjsForLvl($user[UserRoleTableMap::COL_MANAGE_USERS]);

        if (!$user[UserRoleTableMap::COL_MANAGE_USERS]) {
            $parents = self::getChildObjsForLvl();
            $conditions = self::formingConditionByParents($parents, false);
            $accesses = self::getProjectRoles($conditions, $userId);
            self::formingObjsForLvl($objs, $accesses, $user);
        }

        return self::mergeObjsForLvl(
            objs: $objs,
            isAccessManageHistory: $user[UserRoleTableMap::COL_MANAGE_HISTORY],
            isAccessManageUsers: $user[UserRoleTableMap::COL_MANAGE_USERS]
        );
    }

    /**
     * Разрешен ли пользователю CRUD по объекту.
     * Проверка для добавления/редактирования/удаления объекта.
     * @param int $lvl Уровень доступа.
     * @param int $objId ID родителя/объекта (добавление/редактирвоание и удаление).
     * @return bool
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     * @throws PropelException
     */
    public static function isAccessCrudAuthUserByObj(int &$lvl, int &$objId): bool
    {
        self::applyForObj($lvl, $objId);

        $user = self::getAuthUserData();

        if ($user[0][UserRoleTableMap::COL_MANAGE_USERS]) return true;

        $parents = self::getParentsForObj();
        $conditions = self::formingConditionByParents($parents);
        $accesses = self::getProjectRoles($conditions, $user[0][UsersTableMap::COL_ID]);

        self::mergeCrudByUser($accesses, $user);
        self::formingUsersForObj($user);

        return $user[0][self::ARRAY_KEY_IS_CRUD] ?? false;
    }

    #region Apply Function
    private static function applyForObj(int &$lvl, int &$objId): void
    {
        self::$lvl =& $lvl;
        self::$objId =& $objId;
    }

    private static function applyForLvl(int &$lvl, int &$parentId, int &$limit, int &$limitFrom): void
    {
        self::$lvl =& $lvl;
        self::$objId =& $parentId;
        self::$limit =& $limit;
        self::$limitFrom =& $limitFrom;
    }
    #endregion

    #region Getter Query Functions
    /**
     * Запрос на вывод данных пользователя(-ей).
     * @param int|null $userId ID пользователя.
     * @return UsersQuery
     * @throws PropelException
     */
    private static function getUsersQuery(?int $userId = null): UsersQuery
    {
        $i = UsersQuery::create()
            ->select([
                UsersTableMap::COL_ID,
                UsersTableMap::COL_USERNAME,
                UserRoleTableMap::COL_MANAGE_USERS,
                UserRoleTableMap::COL_OBJECT_VIEWER,
                UserRoleTableMap::COL_MANAGE_OBJECTS,
                UserRoleTableMap::COL_MANAGE_VOLUMES,
                UserRoleTableMap::COL_MANAGE_HISTORY,
            ])
            ->leftJoinUserRole()
            ->orderByUsername();

        if ($userId) {
            $i->filterById($userId);
        }

        return $i;
    }

    /**
     * Возвращает запрос на вывод данных об объекте с стоимость и дополнительной фильтрацией.
     * @param bool $isAccessManageUsers Разрешено ли пользователю CRUD учетных записей.
     * @return ObjHouseQuery|\DB\ObjProjectQuery|ObjStageMaterialQuery|ObjStageMaterialVersionQuery|ObjStageTechnicQuery|ObjStageTechnicVersionQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|UserRoleQuery|VolMaterialQuery|VolUnitQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery|VolWorkVersionQuery
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getObjsQuery(bool &$isAccessManageUsers): ObjStageTechnicVersionQuery|VolUnitQuery|VolMaterialQuery|\DB\ObjProjectQuery|VolWorkMaterialQuery|ObjStageTechnicQuery|ObjStageMaterialVersionQuery|UserRoleQuery|VolWorkQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolWorkTechnicQuery|ObjStageWorkQuery|VolWorkVersionQuery
    {
        $i = self::getObjsPriceQuery();

        if (self::$objId) {
            $preLvl = AccessLvl::getPreLvlIntObj(self::$lvl);
            $colId = Objects::getColIdByLvl($preLvl);
            $i->where($colId . '=?', self::$objId);
        }

        if (!$isAccessManageUsers) {
            $colStatus = Objects::getColStatusByLvl(self::$lvl);
            $i->where($colStatus . '!=?', Objects::ATTRIBUTE_STATUS_DELETED);
        }

        if (self::$limitFrom) {
            $colId = Objects::getColIdByLvl(self::$lvl);
            $i->where($colId . '>?', self::$limitFrom);
        }

        return $i->limit(self::$limit)->orderById();
    }

    /**
     * Возвращает запрос на вывод данных об объекте с стоимостью.
     * @return VolUnitQuery|ObjStageTechnicVersionQuery|ObjGroupQuery|VolMaterialQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageMaterialVersionQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageVersionQuery|ObjStageMaterialQuery|VolTechnicQuery|VolWorkTechnicQuery|VolWorkVersionQuery|ObjStageWorkQuery|UsersQuery
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getObjsPriceQuery(): VolUnitQuery|ObjStageTechnicVersionQuery|ObjGroupQuery|VolMaterialQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageMaterialVersionQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageVersionQuery|ObjStageMaterialQuery|VolTechnicQuery|VolWorkTechnicQuery|VolWorkVersionQuery|ObjStageWorkQuery|UsersQuery
    {
        $multiplySwStr = ObjStageWorkTableMap::COL_PRICE . '*' . ObjStageWorkTableMap::COL_AMOUNT;
        $multiplyStStr = ObjStageTechnicTableMap::COL_PRICE . '*' . ObjStageTechnicTableMap::COL_AMOUNT;
        $multiplySmStr = ObjStageMaterialTableMap::COL_PRICE . '*' . ObjStageMaterialTableMap::COL_AMOUNT;
        $sumStr = "ROUND(($multiplySwStr) + ($multiplyStStr) + ($multiplySmStr), 2)";

        return ObjProjectQuery::create()
                ->select([
                    Objects::getColNameByLvl(self::$lvl),
                    Objects::getColStatusByLvl(self::$lvl),
                    Objects::getColIsPublicByLvl(self::$lvl),
                    ObjProjectTableMap::COL_ID,
                    ObjSubprojectTableMap::COL_ID,
                    ObjGroupTableMap::COL_ID,
                    ObjHouseTableMap::COL_ID,
                    ObjStageTableMap::COL_ID,
                    ObjStageWorkTableMap::COL_ID,
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                ])
                ->withColumn($sumStr, self::ARRAY_KEY_PRICE)
                ->leftJoinUsers()
                ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                        ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                            ->useObjStageQuery(joinType: Criteria::LEFT_JOIN)
                                ->useObjStageWorkQuery(joinType: Criteria::LEFT_JOIN)
                                    ->leftJoinObjStageMaterial()
                                    ->leftJoinObjStageTechnic()
                                ->endUse()
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse();
    }

    /**
     * Запрос на вывод IDs родителей объекта/уровня, без условий.
     * @param bool $isObj Используется ли данный запрос для вывода родителей объекта(true)/уровня(false).
     * @return ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|\DB\ObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|ProjectRoleQuery|UserRoleQuery|UsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
     * @throws PropelException
     */
    private static function getParentsQuery(bool $isObj = true): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        if ($isObj === true) {
            $select = array_merge(
                [ObjProjectTableMap::COL_ID],
                (self::$lvl >= eLvlObjInt::SUBPROJECT->value ? [ObjSubprojectTableMap::COL_ID] : []),
                (self::$lvl >= eLvlObjInt::GROUP->value ? [ObjGroupTableMap::COL_ID] : []),
                (self::$lvl >= eLvlObjInt::HOUSE->value ? [ObjHouseTableMap::COL_ID] : []),
                (self::$lvl >= eLvlObjInt::STAGE->value ? [ObjStageTableMap::COL_ID] : []),
            );
        } else {
            $select = [
                ObjProjectTableMap::COL_ID,
                ObjSubprojectTableMap::COL_ID,
                ObjGroupTableMap::COL_ID,
                ObjHouseTableMap::COL_ID,
                ObjStageTableMap::COL_ID,
            ];
        }

        return ObjProjectQuery::create()
            ->distinct()
            ->select($select)
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                        ->leftJoinObjStage()
                    ->endUse()
                ->endUse()
            ->endUse();
    }

    /**
     * Запрос на вывод IDs родителей объекта.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsQueryForObj(): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery();

        if (self::$objId) {
            $colId = Objects::getColIdByLvl(self::$lvl);
            $i->where($colId . '=?', self::$objId);
        }

        return $i;
    }

    /**
     * Запрос на вывод IDs родителей уровня.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     * @throws IncorrectLvlException
     */
    private static function getParentsQueryForLvl(): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery(false);

        if (self::$objId) {
            $preLvl = AccessLvl::getPreLvlIntObj(self::$lvl);
            $colId = Objects::getColIdByLvl($preLvl);
            $i->where($colId . '=?', self::$objId);
        }

        return $i;
    }

    /**
     * Запрос на вывод роле проекта.
     * @param array $conditions Массив условий.
     * @param int|null $userId ID пользователя.
     * @return ProjectRoleQuery|Criteria
     * @throws PropelException
     */
    private static function getProjectRolesQuery(array $conditions, ?int $userId = null): ProjectRoleQuery|Criteria
    {
        $i = ProjectRoleQuery::create()
            ->select([
                ProjectRoleTableMap::COL_LVL,
                ProjectRoleTableMap::COL_IS_CRUD,
                ProjectRoleTableMap::COL_OBJECT_ID,
                ProjectRoleTableMap::COL_USER_ID,
                ProjectRoleTableMap::COL_PROJECT_ID,
            ]);

        if ($conditions) {
            foreach ($conditions as $key=>$value) {
                $i->_or()
                    ->condition("{$key}1", ProjectRoleTableMap::COL_LVL . '=?', $value[ProjectRoleTableMap::COL_LVL])
                    ->condition("{$key}2", ProjectRoleTableMap::COL_OBJECT_ID . '=?', $value[ProjectRoleTableMap::COL_OBJECT_ID])
                    ->where(["{$key}1", "{$key}2"], Criteria::LOGICAL_AND);
            }
        }

        if ($userId) {
            $i->filterByUserId($userId);
        }

        return $i;
    }
    #endregion

    #region Getter By Query Function
    /**
     * Массив данных об авторизированном пользователе.
     * @return array
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    private static function getAuthUserData(): array
    {
        return [
            [
                UsersTableMap::COL_ID => AuthUserRole::getUserId(),
                UsersTableMap::COL_USERNAME => AuthUserRole::getUserName(),
                UserRoleTableMap::COL_MANAGE_USERS => AuthUserRole::isAccessManageUsers(),
                UserRoleTableMap::COL_OBJECT_VIEWER => AuthUserRole::isAccessObjectViewer(),
                UserRoleTableMap::COL_MANAGE_OBJECTS => AuthUserRole::isAccessManageObjects(),
                UserRoleTableMap::COL_MANAGE_VOLUMES => AuthUserRole::isAccessManageVolumes(),
                UserRoleTableMap::COL_MANAGE_HISTORY => AuthUserRole::isAccessManageHistory(),
            ]
        ];
    }

    /**
     * Массив данных о пользователях.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getUsersData(?int $userId = null): array
    {
        return self::getUsersQuery($userId)->find()->getData();
    }

    /**
     * Массив IDs родителей объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsForObj(): array
    {
        return (array)self::getParentsQueryForObj()->findOne();
    }

    /**
     * Массив IDs родителей уровня.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getChildObjsForLvl(): array
    {
        $a = [];
        $r = [];
        $i = self::getParentsQueryForLvl()->find()->getData();

        foreach ($i as &$item) {
            foreach ($item as $key=>&$value) {
                if ($value === null ||
                    (isset($a[$key])) && in_array($value, $a[$key])) continue;

                $a[$key][] =& $value;
            }
        }

        foreach ($a as $key=>&$value) {
            foreach ($value as &$item) {
                $r[][$key] =& $item;
            }
        }

        return $r;
    }

    /**
     * Массив роле проекта.
     * @param array $conditions Массив условий.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getProjectRoles(array &$conditions, ?int $userId = null): array
    {
        return self::getProjectRolesQuery($conditions, $userId)->find()->getData();
    }

    /**
     * Вывод объектов по уровню доступа.
     * @param bool $isAccessManageUsers Разрешен ли пользователю CRUD учетных записей.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getObjsForLvl(bool &$isAccessManageUsers): array
    {
        return self::getObjsQuery($isAccessManageUsers)->find()->getData();
    }
    #endregion

    #region Checking Functions
    /**
     * Разрешен ли пользователю CRUD объекта.
     * @param array $user Массив данных о пользвоателе.
     * @param array $crud Массив разрешений пользователя к объекту.
     * @return bool|null
     */
    private static function isAccessCrud(array $user, array $crud): ?bool
    {
        if ($user[UserRoleTableMap::COL_MANAGE_USERS]) return true;
        if ($crud) return (bool)$crud[ProjectRoleTableMap::COL_IS_CRUD];
        if ($user[UserRoleTableMap::COL_MANAGE_OBJECTS]) return true;
        if ($user[UserRoleTableMap::COL_OBJECT_VIEWER]) return false;

        return null;
    }
    #endregion

    #regions Getter && Setter Functions
    /**
     * Возвращает округленную стоимость с 2 знаками после запятой.
     * @param int|string $price
     * @return string
     */
    private static function getPrice(float $price): string
    {
        return number_format($price, 2, '.', '');
    }
    #endregion

    #region Forming Functions
    /**
     * Объединения данных пользователей и их ролей на объект.
     * @param array $crud Массив ролей проекта.
     * @param array $users Массив пользователей.
     * @param bool $isObj Преднозначен ли данный вывод для объекта, иначе - для уровня.
     * @return void
     */
    private static function mergeCrudByUser(array &$crud, array &$users, bool $isObj = true): void
    {
        foreach ($users as &$user) {
            if ($user[UserRoleTableMap::COL_MANAGE_USERS]) continue;

            foreach ($crud as $access) {
                if ($access[ProjectRoleTableMap::COL_USER_ID] !== $user[UsersTableMap::COL_ID] ||
                    (   $isObj === true &&
                        isset($user[self::ARRAY_KEY_IS_CRUD]) &&
                        $user[self::ARRAY_KEY_IS_CRUD][ProjectRoleTableMap::COL_LVL] >= $access[ProjectRoleTableMap::COL_LVL])
                ) continue;

                if ($isObj === true) $user[self::ARRAY_KEY_IS_CRUD] = $access;
                else $user[self::ARRAY_KEY_IS_CRUD][] = $access;
            }
        }
    }

    /**
     * Формирование данных условий для вывода ролей проекта по IDs родителей.
     * @param array $parents Массив IDs родителей.
     * @param bool $isObj Преднозначен ли данный вывод для объекта, иначе - для уровня.
     * @return array
     * @throws InvalidAccessLvlIntException
     */
    private static function formingConditionByParents(array &$parents, bool $isObj = true): array
    {
        $i = [];

        if ($isObj === true) {
            foreach ($parents as $key=>&$value) {
                if (!$key) $key = ObjProjectTableMap::COL_ID;

                $i[$key] = [
                    ProjectRoleTableMap::COL_LVL => AccessLvl::getLvlIntObjByColId($key),
                    ProjectRoleTableMap::COL_OBJECT_ID => $value,
                ];
            }
        } else {
            foreach ($parents as &$parent) $parent = self::formingConditionByParents($parent);

            foreach ($parents as &$parent) {
                foreach ($parent as &$child) {
                    $i[] =& $child;
                }
            }
        }

        return $i;
    }

    /**
     * Формирование данных пользователей для вывода во вкладку "Управление доступом".
     * @param array $users Массив пользователей.
     * @return void
     */
    private static function formingUsersForObj(array &$users): void
    {
        foreach ($users as &$user) {
            $user = [
                self::ARRAY_KEY_ID => $user[UsersTableMap::COL_ID],
                self::ARRAY_KEY_NAME => $user[UsersTableMap::COL_USERNAME],
                self::ARRAY_KEY_IS_CRUD => self::isAccessCrud($user, $user[self::ARRAY_KEY_IS_CRUD] ?? []),
                self::ARRAY_KEY_IS_ADMIN => (bool)$user[UserRoleTableMap::COL_MANAGE_USERS],
            ];
        }
    }

    /**
     * Формирование данных объектов с разрешениями на объект.
     * @param array $objs Массив объектов.
     * @param array $crud Массив ролей проекта.
     * @param array $user Массив данных пользователя.
     * @return void
     * @throws IncorrectLvlException
     */
    private static function formingObjsForLvl(array &$objs, array &$crud, array &$user): void
    {
        foreach ($objs as &$obj) {
            foreach ($crud as $access) {
                $colId = Objects::getColIdByLvl($access[ProjectRoleTableMap::COL_LVL]);

                if ($obj[$colId] !== $access[ProjectRoleTableMap::COL_OBJECT_ID] &&
                    $obj[ObjProjectTableMap::COL_ID] !== $access[ProjectRoleTableMap::COL_PROJECT_ID]) continue;

//                if (isset($obj[self::ARRAY_KEY_IS_CRUD]) &&
//                    $obj[self::ARRAY_KEY_IS_CRUD][ProjectRoleTableMap::COL_LVL] > $access[ProjectRoleTableMap::COL_LVL] &&
//                    $obj[self::ARRAY_KEY_IS_CRUD][ProjectRoleTableMap::COL_PROJECT_ID] === $access[ProjectRoleTableMap::COL_PROJECT_ID]) continue;

                $obj[self::ARRAY_KEY_IS_CRUD] = $access;
            }
        }

        JsonOutput::success([$objs, $crud]);

        foreach ($objs as &$obj) {
            $obj[self::ARRAY_KEY_IS_CRUD] = self::isAccessCrud($user, $obj[self::ARRAY_KEY_IS_CRUD] ?? []);
        }

        $count = count($objs);

        for ($i = 0; $i < $count; $i++) {
            if ($objs[$i][self::ARRAY_KEY_IS_CRUD] !== null) continue;
            else unset($objs[$i]);
        }
    }

    /**
     * Объединение данных объектов.
     * @param array $objs Массив объектов.
     * @param int $isAccessManageHistory Разрешен ли пользователю CRUD истории изменений.
     * @param int $isAccessManageUsers Разрешен ли пользователю CRUD учетныйх записей.
     * @return array
     * @throws IncorrectLvlException
     */
    private static function mergeObjsForLvl(array &$objs, int &$isAccessManageHistory, int &$isAccessManageUsers): array
    {
        $i = [];
        $colId = Objects::getColIdByLvl(self::$lvl);
        $colName = Objects::getColNameByLvl(self::$lvl);
        $colStatus = Objects::getColStatusByLvl(self::$lvl);
        $colIsPublic = Objects::getColIsPublicByLvl(self::$lvl);

        foreach ($objs as &$obj) {
            $id =& $obj[$colId];

            if (isset($i[$id])) {
                if (!$obj[self::ARRAY_KEY_PRICE]) continue;
                $price = (float)$i[$id][self::ARRAY_KEY_PRICE] + $obj[self::ARRAY_KEY_PRICE];
                $i[$id][self::ARRAY_KEY_PRICE] = self::getPrice($price);
            } else {
                $isCrud = $obj[self::ARRAY_KEY_IS_CRUD] ?? $isAccessManageUsers;
                $i[$id] = [
                    self::ARRAY_KEY_ID => $id,
                    self::ARRAY_KEY_NAME => $obj[$colName],
                    self::ARRAY_KEY_STATUS => $obj[$colStatus],
                    self::ARRAY_KEY_IS_PUBLIC => $obj[$colIsPublic],
                    self::ARRAY_KEY_USER => [
                        self::ARRAY_KEY_ID => $obj[UsersTableMap::COL_ID],
                        self::ARRAY_KEY_NAME => $obj[UsersTableMap::COL_USERNAME],
                    ],
                    self::ARRAY_KEY_PRICE => self::getPrice((float)$obj[self::ARRAY_KEY_PRICE]),
                    self::ARRAY_KEY_IS_CRUD => (bool)$isCrud,
                    self::ARRAY_KEY_IS_HISTORY => $isCrud && $isAccessManageHistory,
                ];
            }
        }

        return array_values($i);
    }
    #endregion
}