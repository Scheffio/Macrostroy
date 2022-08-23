<?php
//Вывод роли.

use DB\Base\RoleQuery;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
    $role_id = (new Request())->getQueryOrThrow('role_id');
    $role = RoleQuery::create()->findPk($role_id)->toArray() ?: throw new Error('No role found');

    JsonOutput::success($role);
} catch (Error $e) {
    JsonOutput::error($e->getMessage());
} catch (Exception $e) {
}
