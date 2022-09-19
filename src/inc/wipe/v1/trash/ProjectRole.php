<?php
namespace trash\projectRole;

use DB\Base\ProjectRoleQuery;
use DB\Base\UsersQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjSubprojectTableMap;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use DB\UsersQuery as DbUsersQuery;
use DB\ObjProjectQuery as DbObjProjectQuery;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;
use DB\Base\ProjectRole as BaseProjectRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoAccessCrudException;
use wipe\inc\v1\role\project_role\exception\NoProjectRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class ProjectRoleV1
{
    #region V1
//    /**
//     * Возвращает массив разрешений пользователей.
//     * @param int $lvl Номер уровня доступа.
//     * @param int $projectId ID проекта.
//     * @param int|null $objId ID объекта.
//     * @param int|null $userId ID пользователя.
//     * @return array
//     * @throws IncorrectLvlException
//     * @throws PropelException
//     */
//    public static function getCrudUsersByObject(int $lvl, int $projectId, ?int $objId = null, ?int $userId = null): array
//    {
//        $parents = null;
//
//        if ($objId) {
//            $parents = self::getParentsId($lvl, $objId);
//        }
//
//        $users = self::getUsersQuery($lvl, $projectId, $userId)->find()->getData();
//
//        if ($users) {
//            self::formingUsersDataById($users);
//            self::filterUsersCrudByLvl($lvl, $users);
//
//            if ($parents) {
//                self::filterUsersCrudDataByParents($parents, $users);
//            }
//
//            self::formingUsersCrud($users);
//        }
//
//        return $users;
//    }
//
//    /**
//     * Получить запрос на вывод пользователей.
//     * @param int $lvl Номер уровня доступа.
//     * @param int|null $projectId ID проекта.
//     * @param int|null $userId ID пользователя.
//     * @return DbUsersQuery
//     * @throws PropelException
//     */
//    private static function getUsersQuery(int $lvl, ?int $projectId = null, ?int $userId = null): DbUsersQuery
//    {
//        $query = UsersQuery::create()
//            ->select([
//                UsersTableMap::COL_ID,
//                UsersTableMap::COL_USERNAME,
//                UserRoleTableMap::COL_MANAGE_USERS,
//                UserRoleTableMap::COL_OBJECT_VIEWER,
//                UserRoleTableMap::COL_MANAGE_OBJECTS,
//                UserRoleTableMap::COL_MANAGE_HISTORY,
//            ])
//            ->withColumn('GROUP_CONCAT(project_role.is_crud)', 'is_crud')
//            ->withColumn('GROUP_CONCAT(project_role.lvl)', 'lvl')
//            ->withColumn('GROUP_CONCAT(project_role.object_id)', 'object_id')
//            ->withColumn('GROUP_CONCAT(project_role.project_id)', 'project_id')
//            ->groupById()
//            ->leftJoinUserRole()
//            ->leftJoinProjectRole()
//            ->filterByIsAvailable(1);
//
//        if ($projectId) {
//            $query->addJoinCondition(
//                name: 'ProjectRole',
//                clause: ProjectRoleTableMap::COL_PROJECT_ID.'=?',
//                value: $projectId
//            );
//        }
//
//        if ($userId) {
//            $query->filterById($userId);
//        }
//
//        return $query;
//    }
//
//    /**
//     * Возвращает массив ID родителей объекта.
//     * @param int $lvl Номер уровня доступа.
//     * @param int $objId ID объекта.
//     * @return array
//     * @throws IncorrectLvlException
//     * @throws PropelException
//     */
//    private static function getParentsId(int $lvl, int $objId): array
//    {
//        $colName = Objects::getColIdByLvl($lvl);
//        $obj = DbObjProjectQuery::create()
//            ->select([
//                ObjProjectTableMap::COL_ID,
//                ObjSubprojectTableMap::COL_ID,
//                ObjGroupTableMap::COL_ID,
//                ObjHouseTableMap::COL_ID,
//                ObjStageTableMap::COL_ID,
//            ])
//            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
//            ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
//            ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
//            ->leftJoinObjStage()
//            ->endUse()
//            ->endUse()
//            ->endUse()
//            ->where($colName.'=?', $objId)
//            ->findOne();
//
//        return [
//            ObjProjectTableMap::COL_ID => &$obj[ObjProjectTableMap::COL_ID],
//            ObjSubprojectTableMap::COL_ID => &$obj[ObjSubprojectTableMap::COL_ID],
//            ObjGroupTableMap::COL_ID => &$obj[ObjGroupTableMap::COL_ID],
//            ObjHouseTableMap::COL_ID => &$obj[ObjHouseTableMap::COL_ID],
//            ObjStageTableMap::COL_ID => &$obj[ObjStageTableMap::COL_ID],
//        ];
//    }
//
//    /**
//     * Формирование данных о пользователе и его разрешениях.
//     * @param array $users Массив данных пользователей.
//     * @return void
//     */
//    private static function formingUsersDataById(array &$users): void
//    {
//        foreach ($users as &$user) {
//            $user['crud'] = [];
//
//            if ($user['lvl'] === null) self::formingUserCrudIsNull($user);
//            else self::formingUserCrud($user);
//
//            self::formingUserData($user, $user['crud']);
//        }
//    }
//
//    /**
//     * Формирование основных данных о пользователе.
//     * @param array $user Массив пользователя.
//     * @param array $crud Массив CRUD пользователя.
//     * @return void
//     */
//    private static function formingUserData(array &$user, array &$crud): void
//    {
//        $user = [
//            'user' => [
//                'id' => $user[UsersTableMap::COL_ID],
//                'name' => $user[UsersTableMap::COL_USERNAME],
//                'manageUsers' => (bool) $user[UserRoleTableMap::COL_MANAGE_USERS],
//                'objectViewer' => (bool) $user[UserRoleTableMap::COL_OBJECT_VIEWER],
//                'manageObjects' => (bool) $user[UserRoleTableMap::COL_MANAGE_OBJECTS],
//                'manageHistory' => (bool) $user[UserRoleTableMap::COL_MANAGE_HISTORY],
//            ],
//            'crud' => $crud
//        ];
//    }
//
//    /**
//     * Формирование CRUD данных о пользователе.
//     * @param array $user Массив пользователя.
//     * @return void
//     */
//    private static function formingUserCrud(array &$user): void
//    {
//        $arrLvl = explode(',', $user['lvl']);
//        $arrCrud = explode(',', $user['is_crud']);
//        $arrObj = explode(',', $user['object_id']);
//
//        for ($i = 0; $i < count($arrLvl); $i++) {
//            $user['crud'][] = [
//                'lvl' => (int)$arrLvl[$i],
//                'isCrud' => (bool)$arrCrud[$i],
//                'object_id' => (int)$arrObj[$i],
//            ];
//        }
//    }
//
//    /**
//     * Формирование пустого CRUD пользователя.
//     * @param array $user Массив пользователя.
//     * @return void
//     */
//    private static function formingUserCrudIsNull(array &$user): void
//    {
//        $user['crud'] = [
//            'lvl' => null,
//            'isCrud' => null,
//            'object_id' => null,
//        ];
//    }
//
//    /**
//     * Формирование разрешений пользователей.
//     * @param array $users Массив полльзователей.
//     * @return void
//     */
//    private static function formingUsersCrud(array &$users): void
//    {
//        foreach ($users as &$user) {
//            $user = [
//                'id' => $user['user']['id'],
//                'name' => $user['user']['name'],
//                'isCrud' => self::getIsCrudByArray(
//                    userCrud: $user['crud'],
//                    isAccessManageUsers: $user['user']['manageUsers'],
//                    isAccessManageObjects: $user['user']['manageObjects'],
//                    isAccessObjectViewer: $user['user']['objectViewer']
//                ),
//                'isAdmin' => $user['user']['manageUsers']
//            ];
//        }
//    }
//
//    /**
//     * Фильстрация массива CRUD разрешений пользователей по номеру уровня доступа.
//     * @param int $lvl Номер уровня доступа.
//     * @param array $users Массив данных о пользователя.
//     * @return void
//     */
//    private static function filterUsersCrudByLvl(int &$lvl, array &$users): void
//    {
//        foreach ($users as &$user) {
//            $crud =& $user['crud'];
//
//            if (!self::isAssociateArray($crud)) {
//                $count = count($crud);
//
//                for ($i = 0; $i < $count; $i++) {
//                    if ($crud[$i]['lvl'] === null) continue;
//                    if ($crud[$i]['lvl'] > $lvl) unset($crud[$i]);
//                }
//
//                $crud = array_values($user['crud']);
//            } elseif ($crud['lvl'] !== null && $crud['lvl'] > $lvl) unset($crud);
//
//            if (!$user['crud']) self::formingUserCrudIsNull($user);
//        }
//    }
//
//    /**
//     * Фильстрация массива CRUD разрешений пользователей по родителям.
//     * @param array $parents Массив родительски ID.
//     * @param array $users Массив пользователей.
//     * @return void
//     * @throws IncorrectLvlException
//     */
//    private static function filterUsersCrudDataByParents(array &$parents, array &$users): void
//    {
//        foreach ($users as &$user) {
//            $crud =& $user['crud'];
//
//            if (!self::isAssociateArray($crud)) {
//                $count = count($crud);
//
//                for ($i = 0; $i < $count; $i++) {
//                    $colName = Objects::getColIdByLvl($crud[$i]['lvl']);
//
//                    if ($crud[$i]['object_id'] !== $parents[$colName]) unset($crud[$i]);
//                }
//
//                $crud = array_values($user['crud']);
//            } elseif ($crud['lvl'] !== null) {
//                $colName = Objects::getColIdByLvl($crud['lvl']);
//
//                if ($crud['object_id'] !== $parents[$colName]) unset($crud);
//            }
//
//            if (!$user['crud']) self::formingUserCrudIsNull($user);
//        }
//    }
//
//    /**
//     * Проверка, является ли массив ассоциативным.
//     * @param array $arr Массив CRUD разрешений пользователя.
//     * @return bool
//     */
//    public static function isAssociateArray(array &$arr): bool
//    {
//        return array_keys($arr) !== range(0, count($arr) - 1);
//    }
//
//    /**
//     * Разрешен ли пользователю CRUD.
//     * @param array $userCrud Массив CRUD разрешений пользователя.
//     * @param bool $isAccessManageUsers Разрешено ли управление пользователя.
//     * @param bool $isAccessManageObjects Разрешено ли управление объектами.
//     * @param bool $isAccessObjectViewer Разрешен ли просмотр объектов.
//     * @return bool
//     */
//    private static function getIsCrudByArray(
//        array $userCrud,
//        bool $isAccessManageUsers,
//        bool $isAccessManageObjects,
//        bool $isAccessObjectViewer
//    ): ?bool
//    {
//        if ($isAccessManageUsers) return true;
//
//        if (!self::isAssociateArray($userCrud)) {
//            $userCrud = array_replace($userCrud);
//
//            foreach ($userCrud as $crud) {
//                if ($crud['isCrud'] !== null) {
//                    return $crud['isCrud'];
//                }
//            }
//        } elseif ($userCrud['isCrud'] !== null) {
//            return $userCrud['isCrud'];
//        }
//
//        if ($isAccessManageObjects) return true;
//        if ($isAccessObjectViewer) return false;
//
//        return null;
//    }
    #endregion

    #region V2
//    /**
//     * Возвращает массив разрешений пользователей.
//     * @param int $lvl Уроыень доступа.
//     * @param int|null $objId ID объекта.
//     * @param int|null $userId ID пользователя.
//     * @return array
//     * @throws IncorrectLvlException
//     * @throws InvalidAccessLvlIntException
//     * @throws PropelException
//     */
//    public static function getCrudUsersByObj(int &$lvl, ?int $objId = null, ?int $userId = null): array
//    {
////        return [];
////        $parents = self::getParentsForObj($lvl, $objId);
////        $parents = self::formingParentsAsCondition($parents);
////
////        $if = self::formingParentsAsIf($parents);
////        $users = self::getUsersCrud($if, $userId);
////
////        return self::formingUsers($users);
//    }
//
//    /**
//     * Взвращает массив IDs родителей объекта.
//     * @param int $lvl Уровень доступа.
//     * @param int $objId ID объекта.
//     * @return array
//     * @throws IncorrectLvlException
//     * @throws PropelException
//     */
//    private static function getParentsForObj(int &$lvl, int &$objId): array
//    {
//        $query = self::getParentsQuery($lvl);
//
//        if ($objId) {
//            $colId = Objects::getColIdByLvl($lvl);
//            $query->where($colId . '=?', $objId);
//        }
//
//        $query = $query->findOne();
//
//        return self::formingParentsResult($lvl, $query);
//    }
//
//    /**
//     * Возвращает массив IDs родителей уровня.
//     * @param int $lvl Уровень доступа.
//     * @param int $parentId ID родителя.
//     * @return array
//     * @throws IncorrectLvlException
//     * @throws InvalidAccessLvlIntException
//     * @throws PropelException
//     */
//    private static function getParentsForLvl(int &$lvl, int &$parentId): array
//    {
//        $query = self::getParentsQuery($lvl);
//
//        if ($parentId) {
//            $preLvl = AccessLvl::getPreLvlIntObj($lvl);
//            $colId = Objects::getColIdByLvl($preLvl);
//            $query->where($colId . '=?', $parentId);
//        }
//
//        $query = $query->find()->getData();
//
//        return self::formingParentsResult($lvl, $query);
//    }
//
//    /**
//     * Возвращает запрос на вывод IDs родителей объекта(уровня), без условия.
//     * @param int $lvl Уроыень достпуа.
//     * @return ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|DbObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|\DB\ProjectRoleQuery|UserRoleQuery|DbUsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
//     * @throws PropelException
//     */
//    private static function getParentsQuery(int $lvl): ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|DbObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|\DB\ProjectRoleQuery|UserRoleQuery|DbUsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
//    {
//        return  ObjProjectQuery::create()
//            ->distinct()
//            ->select(['projectId', 'subprojectId', 'groupId', 'houseId','stageId'])
//            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::PROJECT->value, ObjProjectTableMap::COL_ID), 'projectId')
//            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::SUBPROJECT->value, ObjSubprojectTableMap::COL_ID), 'subprojectId')
//            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::GROUP->value, ObjGroupTableMap::COL_ID), 'groupId')
//            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::HOUSE->value, ObjHouseTableMap::COL_ID), 'houseId')
//            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::STAGE->value, ObjStageTableMap::COL_ID), 'stageId')
//            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
//                ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
//                    ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
//                        ->leftJoinObjStage()
//                    ->endUse()
//                ->endUse()
//            ->endUse();
//    }
//
//    /**
//     * Возвращает массив пользователей, с их разрешениями на объект, соблюдая переданное условие.
//     * @param string $if Строка условия.
//     * @param int|null $userId ID польозвателя.
//     * @return array
//     * @throws PropelException
//     */
//    private static function getUsersCrud(string &$if, ?int $userId = null): array
//    {
//        $query = UsersQuery::create()
//            ->distinct()
//            ->select([
//                UsersTableMap::COL_ID,
//                UsersTableMap::COL_USERNAME,
//                UserRoleTableMap::COL_MANAGE_USERS,
//                UserRoleTableMap::COL_OBJECT_VIEWER,
//                UserRoleTableMap::COL_MANAGE_OBJECTS,
//                UserRoleTableMap::COL_MANAGE_VOLUMES,
//                UserRoleTableMap::COL_MANAGE_HISTORY,
//            ])
//            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_LVL), 'lvl')
//            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_IS_CRUD), 'isCrud')
//            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_OBJECT_ID), 'objId')
//            ->leftJoinUserRole()
//            ->leftJoinProjectRole()
//            ->orderByUsername(Criteria::ASC);
//
//        if ($userId) {
//            $query->filterById($userId);
//        }
//
//        return $query->find()->getData();
//    }
//
//    /**
//     * Получить условие для вывода используя уровень для сравнения.
//     * @param int $lvl Уровень доступа, с которым сравнимают.
//     * @param int $lvlObj Уровень доступа, который сравнивают.
//     * @param string $true Наименование атрибута, который выводится при положительном результате сранения.
//     * @return string
//     */
//    private static function getIfByLvl(int $lvl, int $lvlObj, string $true): string
//    {
//        return "IF ($lvl >= $lvlObj, $true, null)";
//    }
//
//    /**
//     * Разрешен ли CRUD объекта для пользователя.
//     * @param int|bool|null $crud Разрешение пользователя на объект.
//     * @param array $user Данные о пользователе.
//     * @return bool|null
//     */
//    private static function isCrud(null|int|bool &$crud, array &$user): ?bool
//    {
//        if ($user[UserRoleTableMap::COL_MANAGE_USERS]) return true;
//        if ($crud !== null) return (bool)$crud;
//        if ($user[UserRoleTableMap::COL_MANAGE_OBJECTS]) return true;
//        if ($user[UserRoleTableMap::COL_OBJECT_VIEWER]) return false;
//
//        return null;
//    }
//
//    /**
//     * Возвращает строку, с замененным значением при true условия.
//     * @param string $if Строка с условием для вывода.
//     * @param string $true Значение, которое выводится при true условия.
//     * @return string
//     */
//    private static function replaceValueInIf(string $if, string $true): string
//    {
//        return str_replace('true', $true, $if);
//    }
//
//    /**
//     * Корректирование массива данных IDs родителей объекта (уровня).
//     * @param int $lvl Уровень доступа.
//     * @param array|null $result Результат запроса.
//     * @return array
//     */
//    private static function formingParentsResult(int &$lvl, null|array &$result): array
//    {
//        if ($result) {
//            if (array_key_exists('projectId', $result)) {
//                $result = array_combine(
//                    [
//                        ObjProjectTableMap::COL_ID,
//                        ObjSubprojectTableMap::COL_ID,
//                        ObjGroupTableMap::COL_ID,
//                        ObjHouseTableMap::COL_ID,
//                        ObjStageTableMap::COL_ID
//                    ],
//                    array_values($result)
//                );
//
//                return array_slice($result, 0, $lvl);
//            }
//
//            foreach ($result as &$item) {
//                $item = self::formingParentsResult($lvl, $item);
//            }
//        }
//
//        return $result ?? [];
//    }
//
//    /**
//     * Формирование массива IDs родителей объекта, в качестве условий.
//     * @param array $parents Массив IDs родителей объекта.
//     * @return void
//     * @throws InvalidAccessLvlIntException
//     */
//    private static function formingParentsAsCondition(array &$parents): array
//    {
//        if (array_key_exists(ObjProjectTableMap::COL_ID, $parents)) {
//            foreach ($parents as $key=>&$value) {
//                $lvl = AccessLvl::getLvlIntObjByColId($key);
//                $wLvl = ProjectRoleTableMap::COL_LVL . '=' . $lvl;
//                $wObjId = ProjectRoleTableMap::COL_OBJECT_ID . '=' . $value;
//                $value = [$wLvl, $wObjId];
//            }
//        } else {
//            foreach ($parents as &$parent) {
//                $parent = self::formingParentsAsCondition($parent);
//            }
//        }
//
//        return $parents;
//    }
//
//    /**
//     * Формирование массива IDs родителей объекта, в качестве условий по уровню и ID объекта для таблицы ролей проекта.
//     * @param array $parents Массив IDs родителей объекта.
//     * @return string
//     */
//    private static function formingParentsAsIf(array $parents): string
//    {
//        foreach ($parents as &$parent) {
//            $parent = "($parent[0] AND $parent[1])";
//        }
//
//        return 'IF(' . join(' OR ', $parents) . ', true, NULL)';
//    }
//
//    /**
//     * Форирование массива пользователей.
//     * @param array $users Массив пользователей.
//     * @return array
//     */
//    private static function formingUsers(array &$users): array
//    {
//        $result = [];
//
//        foreach ($users as &$user) {
//            $id =& $user[UsersTableMap::COL_ID];
//            $flag = array_key_exists($id, $result);
//
//            if ($flag &&
//                $result[$id]['lvl'] !== null &&
//                $result[$id]['lvl'] > (int)$user['lvl']) continue;
//            elseif (!$flag) $result[$id] =& $user;
//            else {
//                $result[$id]['lvl'] =& $user['lvl'];
//                $result[$id]['isCrud'] =& $user['isCrud'];
//                $result[$id]['objId'] =& $user['objId'];
//            }
//        }
//
//        foreach ($result as &$item) {
//            $item = [
//                'id' => $item[UsersTableMap::COL_ID],
//                'name' => $item[UsersTableMap::COL_USERNAME],
//                'isCrud' => self::isCrud($item['isCrud'], $item),
//                'isAdmin' => (bool)$item[UserRoleTableMap::COL_MANAGE_USERS]
//            ];
//        }
//
//        return array_values($result);
//    }
    #endregion
}