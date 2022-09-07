<?php
//Вывод роли.

use DB\Base\UserRoleQuery;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Map\TableMap;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    $role_id = (new Request())->getQueryOrThrow('role_id');

    $role = UserRoleQuery::create()->findPk($role_id)->toArray(TableMap::TYPE_FIELDNAME)
            ?: throw new Error('No role found');

    JsonOutput::success($role);
} catch (Exception|Error $e) {
    JsonOutput::error($e->getMessage());
}
