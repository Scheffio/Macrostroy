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
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\user_role\AuthUserRole;

$request = new Request();

try {
    $lvl = $request->getQueryOrThrow('lvl');
    $objId = $request->getQueryOrThrow('object_id');

    $users = Selector::getUsers();
    $parents = Selector::getParentsForObj($lvl, $objId);
    Selector::formingParentsAsCondition($parents);
    $access = Selector::getObjAccesses($parents);

    JsonOutput::success([
        $parents,
        $access
    ]);

} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}

class Selector
{
    public static function getUsers(): array
    {
        return UsersQuery::create()
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
            ->find()
            ->getData();
    }

    public static function getParentsForObj(int $lvl, int $objId): array
    {
        $query = ObjProjectQuery::create()
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
                ->endUse();

        if ($objId) {
            $colId = Objects::getColIdByLvl($lvl);
            $query->where($colId . '=?', $objId);
        }

        $query = $query->findOne();

        return is_array($query) ? array_slice($query, 0, $lvl) : [];
    }

    public static function getObjAccesses(array $where, ?int $userId = null)
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

    public static function formingParentsAsCondition(array &$parents): void
    {
        foreach ($parents as $key=>&$value) {
            $lvl = AccessLvl::getLvlIntObjByColId($key);
            $wLvl = ProjectRoleTableMap::COL_LVL . '=' . $lvl;
            $wObjId = ProjectRoleTableMap::COL_OBJECT_ID . '=' . $value;
            $value = [$wLvl, $wObjId];
        }

        $parents['null'] = [
            ProjectRoleTableMap::COL_LVL . ' IS NULL',
            ProjectRoleTableMap::COL_OBJECT_ID . ' IS NULL',
        ];
    }

    public static function formingUsersCrud(array $users, array $crud)
    {

    }

    public static function formingAuthUserCrud(array $crud)
    {

    }
}