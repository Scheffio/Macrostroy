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
    #region Static Select CRUD Users Object
    /**
     * Возвращает массив разрешений пользователей.
     * @param int $lvl Номер уровня доступа.
     * @param int $projectId ID проекта.
     * @param int|null $objId ID объекта.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    public static function getCrudUsersByObject(int $lvl, int $projectId, ?int $objId = null, ?int $userId = null): array
    {
        $parents = null;

        if ($objId) {
            $parents = self::getParentsId($lvl, $objId);
        }

        $users = self::getUsersQuery($lvl, $projectId, $userId)->find()->getData();

        if ($users) {
            self::formingUsersDataById($users);
            self::filterUsersCrudByLvl($lvl, $users);

            if ($parents) {
                self::filterUsersCrudDataByParents($parents, $users);
            }

            self::formingUsersCrud($users);
        }

        return $users;
    }

    /**
     * Получить запрос на вывод пользователей.
     * @param int $lvl Номер уровня доступа.
     * @param int|null $projectId ID проекта.
     * @param int|null $userId ID пользователя.
     * @return DbUsersQuery
     * @throws PropelException
     */
    private static function getUsersQuery(int $lvl, ?int $projectId = null, ?int $userId = null): DbUsersQuery
    {
        $query = UsersQuery::create()
            ->select([
                UsersTableMap::COL_ID,
                UsersTableMap::COL_USERNAME,
                UserRoleTableMap::COL_MANAGE_USERS,
                UserRoleTableMap::COL_OBJECT_VIEWER,
                UserRoleTableMap::COL_MANAGE_OBJECTS,
                UserRoleTableMap::COL_MANAGE_HISTORY,
            ])
            ->withColumn('GROUP_CONCAT(project_role.is_crud)', 'is_crud')
            ->withColumn('GROUP_CONCAT(project_role.lvl)', 'lvl')
            ->withColumn('GROUP_CONCAT(project_role.object_id)', 'object_id')
            ->withColumn('GROUP_CONCAT(project_role.project_id)', 'project_id')
            ->groupById()
            ->leftJoinUserRole()
            ->leftJoinProjectRole()
            ->filterByIsAvailable(1);

        if ($projectId) {
            $query->addJoinCondition(
                name: 'ProjectRole',
                clause: ProjectRoleTableMap::COL_PROJECT_ID.'=?',
                value: $projectId
            );
        }

        if ($userId) {
            $query->filterById($userId);
        }

        return $query;
    }

    /**
     * Возвращает массив ID родителей объекта.
     * @param int $lvl Номер уровня доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsId(int $lvl, int $objId): array
    {
        $colName = Objects::getColIdByLvl($lvl);
        $obj = DbObjProjectQuery::create()
            ->select([
                ObjProjectTableMap::COL_ID,
                ObjSubprojectTableMap::COL_ID,
                ObjGroupTableMap::COL_ID,
                ObjHouseTableMap::COL_ID,
                ObjStageTableMap::COL_ID,
            ])
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
            ->leftJoinObjStage()
            ->endUse()
            ->endUse()
            ->endUse()
            ->where($colName.'=?', $objId)
            ->findOne();

        return [
            ObjProjectTableMap::COL_ID => &$obj[ObjProjectTableMap::COL_ID],
            ObjSubprojectTableMap::COL_ID => &$obj[ObjSubprojectTableMap::COL_ID],
            ObjGroupTableMap::COL_ID => &$obj[ObjGroupTableMap::COL_ID],
            ObjHouseTableMap::COL_ID => &$obj[ObjHouseTableMap::COL_ID],
            ObjStageTableMap::COL_ID => &$obj[ObjStageTableMap::COL_ID],
        ];
    }

    /**
     * Формирование данных о пользователе и его разрешениях.
     * @param array $users Массив данных пользователей.
     * @return void
     */
    private static function formingUsersDataById(array &$users): void
    {
        foreach ($users as &$user) {
            $user['crud'] = [];

            if ($user['lvl'] === null) self::formingUserCrudIsNull($user);
            else self::formingUserCrud($user);

            self::formingUserData($user, $user['crud']);
        }
    }

    /**
     * Формирование основных данных о пользователе.
     * @param array $user Массив пользователя.
     * @param array $crud Массив CRUD пользователя.
     * @return void
     */
    private static function formingUserData(array &$user, array &$crud): void
    {
        $user = [
            'user' => [
                'id' => $user[UsersTableMap::COL_ID],
                'name' => $user[UsersTableMap::COL_USERNAME],
                'manageUsers' => (bool) $user[UserRoleTableMap::COL_MANAGE_USERS],
                'objectViewer' => (bool) $user[UserRoleTableMap::COL_OBJECT_VIEWER],
                'manageObjects' => (bool) $user[UserRoleTableMap::COL_MANAGE_OBJECTS],
                'manageHistory' => (bool) $user[UserRoleTableMap::COL_MANAGE_HISTORY],
            ],
            'crud' => $crud
        ];
    }

    /**
     * Формирование CRUD данных о пользователе.
     * @param array $user Массив пользователя.
     * @return void
     */
    private static function formingUserCrud(array &$user): void
    {
        $arrLvl = explode(',', $user['lvl']);
        $arrCrud = explode(',', $user['is_crud']);
        $arrObj = explode(',', $user['object_id']);

        for ($i = 0; $i < count($arrLvl); $i++) {
            $user['crud'][] = [
                'lvl' => (int)$arrLvl[$i],
                'isCrud' => (bool)$arrCrud[$i],
                'object_id' => (int)$arrObj[$i],
            ];
        }
    }

    /**
     * Формирование пустого CRUD пользователя.
     * @param array $user Массив пользователя.
     * @return void
     */
    private static function formingUserCrudIsNull(array &$user): void
    {
        $user['crud'] = [
            'lvl' => null,
            'isCrud' => null,
            'object_id' => null,
        ];
    }

    /**
     * Формирование разрешений пользователей.
     * @param array $users Массив полльзователей.
     * @return void
     */
    private static function formingUsersCrud(array &$users): void
    {
        foreach ($users as &$user) {
            $user = [
                'id' => $user['user']['id'],
                'name' => $user['user']['name'],
                'isCrud' => self::getIsCrudByArray(
                    userCrud: $user['crud'],
                    isAccessManageUsers: $user['user']['manageUsers'],
                    isAccessManageObjects: $user['user']['manageObjects'],
                    isAccessObjectViewer: $user['user']['objectViewer']
                ),
                'isAdmin' => $user['user']['manageUsers']
            ];
        }
    }

    /**
     * Фильстрация массива CRUD разрешений пользователей по номеру уровня доступа.
     * @param int $lvl Номер уровня доступа.
     * @param array $users Массив данных о пользователя.
     * @return void
     */
    private static function filterUsersCrudByLvl(int &$lvl, array &$users): void
    {
        foreach ($users as &$user) {
            $crud =& $user['crud'];

            if (!self::isAssociateArray($crud)) {
                $count = count($crud);

                for ($i = 0; $i < $count; $i++) {
                    if ($crud[$i]['lvl'] === null) continue;
                    if ($crud[$i]['lvl'] > $lvl) unset($crud[$i]);
                }

                $crud = array_values($user['crud']);
            } elseif ($crud['lvl'] !== null && $crud['lvl'] > $lvl) unset($crud);

            if (!$user['crud']) self::formingUserCrudIsNull($user);
        }
    }

    /**
     * Фильстрация массива CRUD разрешений пользователей по родителям.
     * @param array $parents Массив родительски ID.
     * @param array $users Массив пользователей.
     * @return void
     * @throws IncorrectLvlException
     */
    private static function filterUsersCrudDataByParents(array &$parents, array &$users): void
    {
        foreach ($users as &$user) {
            $crud =& $user['crud'];

            if (!self::isAssociateArray($crud)) {
                $count = count($crud);

                for ($i = 0; $i < $count; $i++) {
                    $colName = Objects::getColIdByLvl($crud[$i]['lvl']);

                    if ($crud[$i]['object_id'] !== $parents[$colName]) unset($crud[$i]);
                }

                $crud = array_values($user['crud']);
            } elseif ($crud['lvl'] !== null) {
                $colName = Objects::getColIdByLvl($crud['lvl']);

                if ($crud['object_id'] !== $parents[$colName]) unset($crud);
            }

            if (!$user['crud']) self::formingUserCrudIsNull($user);
        }
    }

    /**
     * Проверка, является ли массив ассоциативным.
     * @param array $arr Массив CRUD разрешений пользователя.
     * @return bool
     */
    public static function isAssociateArray(array &$arr): bool
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * Разрешен ли пользователю CRUD.
     * @param array $userCrud Массив CRUD разрешений пользователя.
     * @param bool $isAccessManageUsers Разрешено ли управление пользователя.
     * @param bool $isAccessManageObjects Разрешено ли управление объектами.
     * @param bool $isAccessObjectViewer Разрешен ли просмотр объектов.
     * @return bool
     */
    private static function getIsCrudByArray(
        array $userCrud,
        bool $isAccessManageUsers,
        bool $isAccessManageObjects,
        bool $isAccessObjectViewer
    ): ?bool
    {
        if ($isAccessManageUsers) return true;

        if (!self::isAssociateArray($userCrud)) {
            $userCrud = array_replace($userCrud);

            foreach ($userCrud as $crud) {
                if ($crud['isCrud'] !== null) {
                    return $crud['isCrud'];
                }
            }
        } elseif ($userCrud['isCrud'] !== null) {
            return $userCrud['isCrud'];
        }

        if ($isAccessManageObjects) return true;
        if ($isAccessObjectViewer) return false;

        return null;
    }
    #endregion
}