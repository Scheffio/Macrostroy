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
    $parent = Selector::getParentsByObj($lvl, $objId);

    JsonOutput::success([
        $parent,
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

    public static function getParentsByObj(int $lvl, int $objId)
    {
        $query = ObjProjectQuery::create()
                ->select([
                    ObjProjectTableMap::COL_ID,
                    ObjSubprojectTableMap::COL_ID,
//                    ObjGroupTableMap::COL_ID,
//                    ObjHouseTableMap::COL_ID,
//                    ObjStageTableMap::COL_ID,
                ])
                ->withColumn('(IF ' . $lvl . '>=' . eLvlObjInt::PROJECT->value . ',' . ObjProjectTableMap::COL_ID . ', null)', 'project')
                ->withColumn('(IF ' . $lvl . '>=' . eLvlObjInt::SUBPROJECT->value . ',' . ObjSubprojectTableMap::COL_ID . ', null)', 'subproject')
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

        return $query->findOne();
    }

    public static function getParentsByLvl(int $lvl, int $parentId)
    {

    }

    public static function getWhereByParents(array $parents)
    {

    }

    public static function getObjAccesses(int $lvl, int $obj, array $where, ?int $userId = null)
    {

    }

    public static function formingUsersCrud(array $users, array $crud)
    {

    }

    public static function formingAuthUserCrud(array $crud)
    {

    }
}