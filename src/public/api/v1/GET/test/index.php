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
    $userId = AuthUserRole::getUserId();

} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}

class Selector
{
    public static function getUsers()
    {

    }

    public static function getParents(int $lvl, int $obj)
    {

    }

    public static function getWhereByParents(array $parents)
    {

    }

    public static function getObjAccesses(int $lvl, int $obj, array $where)
    {

    }

    public static function metgeUsersCrud()
    {
        
    }
}