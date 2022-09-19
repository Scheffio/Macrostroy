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
use DB\ObjStageQuery;
use DB\ObjStageTechnicQuery;
use DB\ObjStageVersionQuery;
use DB\ObjStageWorkQuery;
use DB\ObjSubprojectQuery;
use DB\ProjectRoleQuery;
use DB\UserRoleQuery;
use DB\UsersQuery;
use DB\VolMaterialQuery;
use DB\VolTechnicQuery;
use DB\VolWorkMaterialQuery;
use DB\VolWorkQuery;
use DB\VolWorkTechnicQuery;
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

    /**
     * Массив разрешений пользователей к объекту.
     * Вывод для вкладки "Управление доступом".
     * @param int $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    public static function getUsersCrudForObj(int &$lvl, int &$objId, ?int $userId = null)
    {
        $users = self::getUsersData($userId);
        $parents = self::getParentsForObj($lvl, $objId);
        $conditions = self::formingConditionByParents($parents);
        $accesses = self::getProjectRoles($conditions, $userId);

        self::mergeCrudByUser($accesses, $users);
        self::formingUsersForObj($users);

        return $users;
    }

    public static function getAuthUserCrudForLvl(int &$lvl, int &$parentId)
    {
        $user = self::getAuthUserData();
        $parents = self::getParentsForLvl($lvl, $parentId);
        $conditions = self::formingConditionByParents($parents, false);
        $accesses = self::getProjectRoles($conditions, 17);

        return [
            '$conditions' => $conditions,
            '$accesses' => $accesses
        ];
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
        $user = self::getAuthUserData();

        if ($user[0][UserRoleTableMap::COL_MANAGE_USERS]) return true;

        $parents = self::getParentsForObj($lvl, $objId);
        $conditions = self::formingConditionByParents($parents);
        $accesses = self::getProjectRoles($conditions, $user[0][UsersTableMap::COL_ID]);

        self::mergeCrudByUser($accesses, $user);
        self::formingUsersForObj($user);

        return $user[0][self::ARRAY_KEY_IS_CRUD] ?? false;
    }

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

    private static function getLvlQuery(int &$lvl, int &$parentId, int|bool $isAccessManageUsers)
    {
        $multiplySwStr = ObjStageWorkTableMap::COL_PRICE . '*' . ObjStageWorkTableMap::COL_AMOUNT;
        $multiplyStStr = ObjStageTechnicTableMap::COL_PRICE . '*' . ObjStageTechnicTableMap::COL_AMOUNT;
        $multiplySmStr = ObjStageMaterialTableMap::COL_PRICE . '*' . ObjStageMaterialTableMap::COL_AMOUNT;
        $sumStr = "ROUND(($multiplySwStr) + ($multiplyStStr) + ($multiplySmStr), 2)";

        


    }

    /**
     * Запрос на вывод IDs родителей объекта/уровня, без условий.
     * @param int $lvl Уровень доступа.
     * @return ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|\DB\ObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|ProjectRoleQuery|UserRoleQuery|UsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
     * @throws PropelException
     */
    private static function getParentsQuery(int $lvl): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        return ObjProjectQuery::create()
            ->distinct()
            ->select(array_merge(
                [ObjProjectTableMap::COL_ID],
                ($lvl >= eLvlObjInt::SUBPROJECT->value ? [ObjSubprojectTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::GROUP->value ? [ObjGroupTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::HOUSE->value ? [ObjHouseTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::STAGE->value ? [ObjStageTableMap::COL_ID] : []),
            ))
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
     * @param int $lvl Уровень досиупа.
     * @param int $objId ID родителя объекта.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsQueryForObj(int $lvl, int $objId): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery($lvl);

        if ($objId) {
            $colId = Objects::getColIdByLvl($lvl);
            $i->where($colId . '=?', $objId);
        }

        return $i;
    }

    /**
     * Запрос на вывод IDs родителей уровня.
     * @param int $lvl Уровень досиупа.
     * @param int $parentId ID родителя объекта.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     * @throws IncorrectLvlException
     */
    private static function getParentsQueryForLvl(int $lvl, int $parentId): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery($lvl);

        if ($parentId) {
            $preLvl = AccessLvl::getPreLvlIntObj($lvl);
            $colId = Objects::getColIdByLvl($preLvl);
            $i->where($colId . '=?', $parentId);
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
     * @param int $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsForObj(int $lvl, int $objId): array
    {
        return (array)self::getParentsQueryForObj($lvl, $objId)->findOne();
    }

    /**
     * Массив IDs родителей уровня.
     * @param int $lvl Уровень доступа.
     * @param int $parentId ID родительсткого объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getParentsForLvl(int $lvl, int $parentId): array
    {
        $i = self::getParentsQueryForLvl($lvl, $parentId)->find()->getData();

        return $lvl === eLvlObjInt::PROJECT->value
            ? array_map(fn($e) => [ObjProjectTableMap::COL_ID => $e], $i)
            : $i;
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

    #endregion

    #region Forming Functions
    /**
     * Объединения данных пользователей и их ролей на объект.
     * @param array $crud Массив ролей проекта.
     * @param array $users Массив пользователей.
     * @param bool $isObj Преднозначен ли данный вывод для объекта, иначе - для уровня.
     * @return void
     */
    private static function mergeCrudByUser(array $crud, array &$users, bool $isObj = true): void
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

    private static function formingCrudByObj(array &$objs, array &$crud): void
    {

    }
    #endregion
}