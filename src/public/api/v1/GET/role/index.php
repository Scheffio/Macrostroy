<?php
//Вывод роли.

use DB\Base\RoleQuery;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
    $role_id = (new Request())->getQueryOrThrow('role_id');

    JsonOutput::success(
        RoleQuery::create()
            ->select(['id', 'name'])
            ->findById($role_id)
            ->getData()
    );

//    ?: throw new Error()
} catch (PropelException|Error $e) {
    JsonOutput::error($e->getMessage());
}
