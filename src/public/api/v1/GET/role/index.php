<?php
//Вывод роли.

use DB\Base\RoleQuery;
use DB\Map\RoleTableMap;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
    $role_id = (new Request())->getQueryOrThrow('role_id');
    $role = RoleQuery::create()
                ->select([
                    RoleTableMap::COL_ID,
                    RoleTableMap::COL_NAME,
                    RoleTableMap::COL_OBJECT_VIEWER,
                    RoleTableMap::COL_MANAGE_OBJECTS,
                    RoleTableMap::COL_MANAGE_VOLUMES,
                    RoleTableMap::COL_MANAGE_HISTORY,
                    RoleTableMap::COL_MANAGE_USERS
                ])
                ->findById($role_id)
                ->getData() ?: throw new Error('No role found');

    $role = array_map(function($value, $key) {
        return explode('.', $key)[1];
    }, $role);

    JsonOutput::success($role);
} catch (PropelException|Error $e) {
    JsonOutput::error($e->getMessage());
}
