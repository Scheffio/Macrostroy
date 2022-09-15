<?php

use DB\Base\ObjProjectQuery;
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
use DB\ObjProjectQuery as DbObjProjectQuery;
use DB\UsersQuery as DbUsersQuery;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\user_role\AuthUserRole;

$request = new Request();

try {
    $lvl = $request->getQueryOrThrow('lvl');
    $objId = $request->getQueryOrThrow('object_id');
    $userId = AuthUserRole::getUserId();

    JsonOutput::success(SelectUsersCrud::getUsersCrud($lvl, $objId, $userId));

} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}

class SelectUsersCrud
{
    /**
     * @param int $lvl
     * @param int $objId
     * @param int $userId
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    public static function getUsersCrud(int &$lvl, int &$objId, int &$userId): array
    {
        $users = self::getUsers();
        $where = self::formingWhere(self::getObjParents($lvl, $objId));
        JsonOutput::success(self::getSortCrud(self::getProjectCrud($where)));
        $crud = self::getSortCrud(self::getProjectCrud($where));
        self::formingUsersCrud($users, $crud);

        return $users;
    }

    #region OriginalFunction
    /**
     * Возвращает IDs родителей объекта.
     * @param int $lvl
     * @param int $objId
     * @return mixed
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getObjParents(int &$lvl, int &$objId): mixed
    {
        $colId = Objects::getColIdByLvl($lvl);

        return ObjProjectQuery::create()
            ->select(self::getSelectParentsByLvl($lvl))
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                        ->leftJoinObjStage()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->where($colId.'=?', $objId)
            ->findOne();
    }

    /**
     * Массив значений для вывода в запросе на получение IDs родителей объекта.
     * @param int $lvl Уровень доступа.
     * @return array
     */
    private static function getSelectParentsByLvl(int &$lvl): array
    {
        $select = [];

        if ($lvl >= eLvlObjInt::PROJECT->value) $select[] = ObjProjectTableMap::COL_ID;
        if ($lvl >= eLvlObjInt::SUBPROJECT->value) $select[] = ObjSubprojectTableMap::COL_ID;
        if ($lvl >= eLvlObjInt::GROUP->value) $select[] = ObjGroupTableMap::COL_ID;
        if ($lvl >= eLvlObjInt::HOUSE->value) $select[] = ObjHouseTableMap::COL_ID;
        if ($lvl >= eLvlObjInt::STAGE->value) $select[] = ObjStageTableMap::COL_ID;

        return $select;
    }

    /**
     * Возвращает пользователя(-ей) и его(их) разрешения.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getUsers(?int $userId = null): array
    {
        $query = UsersQuery::create()
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
                ->filterByIsAvailable(1);

        if ($userId) {
            $query->filterById($userId);
        }

        return $query->find()->getData();
    }

    /**
     * Возвращает пользователей с их рахрешениями по объектам.
     * @param array $where Массив условий по IDs родителей объекта.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getProjectCrud(array &$where, ?int $userId = null): array
    {
        $query = ProjectRoleQuery::create()
            ->select([
                ProjectRoleTableMap::COL_USER_ID,
                ProjectRoleTableMap::COL_LVL,
                ProjectRoleTableMap::COL_IS_CRUD,
                ProjectRoleTableMap::COL_OBJECT_ID,
                ProjectRoleTableMap::COL_PROJECT_ID,
            ]);

        if ($where) {
            foreach ($where as $key=>$value) {
                $query
                    ->_or()
                    ->condition("{$key}1" ,$value[0])
                    ->condition("{$key}2" ,$value[1])
                    ->where(["{$key}1", "{$key}2"], Criteria::LOGICAL_AND);
            }
        }

        if ($userId) {
            $query->filterByUserId($userId);
        }

        return $query->find()->getData();
    }

    /**
     * Возвращает отсортированный массив разрешений по убыванию уровня доступа.
     * @param array $crud Массив разрешений по IDs родителей объекта.
     * @return array
     */
    private static function getSortCrud(array $crud): array
    {
        $i = [];
        $a = [];

        foreach ($crud as $item) {
            JsonOutput::success($item);
            $i[$item[ProjectRoleTableMap::COL_LVL]][] = $item;
        }

        rsort($i);

        foreach ($i as $item) {
            $a = array_merge($a, $item);
        }

        return $a;
    }

    /**
     * Разрешен ли CRUD пользователю по роли проекта.
     * @param int|bool|null $crud Разрешения по роли проекта.
     * @param array $user Массив данных пользователя.
     * @return bool|null
     */
    private static function isCrud(null|int|bool &$crud, array &$user): ?bool
    {
        if ($user[UserRoleTableMap::COL_MANAGE_USERS]) return true;
        if ($crud !== null) return (bool)$crud;
        if ($user[UserRoleTableMap::COL_MANAGE_OBJECTS]) return true;
        if ($user[UserRoleTableMap::COL_OBJECT_VIEWER]) return false;

        return null;
    }

    /**
     * Формирование массива условий по IDs родителей объекта.
     * @param array $parents IDs родителей объекта.
     * @return array
     * @throws IncorrectLvlException
     */
    private static function formingWhere(array $parents): array
    {
        $parents = array_filter($parents, fn($e) => $e !== null);

        foreach ($parents as $key=>&$value) {
            $lvl = self::getLvlIntObjByColId($key);
            $wLvl = ProjectRoleTableMap::COL_LVL . '=' . $lvl;
            $wObjId = ProjectRoleTableMap::COL_OBJECT_ID . '=' . $value;
            $value = [$wLvl, $wObjId];
        }

        $parents['null'] = [
            ProjectRoleTableMap::COL_LVL . ' IS NULL',
            ProjectRoleTableMap::COL_OBJECT_ID . ' IS NULL',
        ];

        return $parents;
    }

    /**
     * Формирование массива пользователей и их разрешением на CRUD объекта.
     * @param array $users Массив пользователей.
     * @param array $crud Массив разрешений по объекту.
     * @return void
     */
    private static function formingUsersCrud(array &$users, array &$crud): void
    {
        foreach ($crud as $access) {
            foreach ($users as &$user) {
                if ($user[UsersTableMap::COL_ID] !== $access[ProjectRoleTableMap::COL_USER_ID]) continue;
                else $user['crud'][] = $access;
            }
        }

        foreach ($users as &$user) {
            $crud = $user['crud'][0][ProjectRoleTableMap::COL_IS_CRUD] ?? null;

            $user = [
                'id' => $user[UsersTableMap::COL_ID],
                'name' => $user[UsersTableMap::COL_USERNAME],
                'isCrud' => self::isCrud($crud, $user),
            ];
        }
    }
    #endregion

    #region Add AccessLvlFunctions
    /**
     * Возвращает номер уровня доступа объекта, используя наименование ID атрибута таблицы.
     * @param string $colId Наименование ID атрибута таблицы (MapTable).
     * @return int
     * @throws IncorrectLvlException
     */
    public static function getLvlIntObjByColId(string $colId): int
    {
        return match ($colId) {
            ObjProjectTableMap::COL_ID => eLvlObjInt::PROJECT->value,
            ObjSubprojectTableMap::COL_ID => eLvlObjInt::SUBPROJECT->value,
            ObjGroupTableMap::COL_ID => eLvlObjInt::GROUP->value,
            ObjHouseTableMap::COL_ID => eLvlObjInt::HOUSE->value,
            ObjStageTableMap::COL_ID => eLvlObjInt::STAGE->value,
            default => throw new IncorrectLvlException()
        };
    }
    #endregion
}