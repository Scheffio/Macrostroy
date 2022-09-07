<?php
// Присваивание роли пользователю.

use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

$user = new UserRole();
$request = new Request();

try {
    $user->applyByUserAuth()->isAccessManageUsersOrThrow();
    $request->checkRequestVariablesOrError('user_id', 'role_id');

    $user_id = $request->getRequest("user_id");
    $role_id = $request->getRequest("role_id");

    $user
        ->setUserId($user_id)
        ->setRoleId($role_id)
        ->updateUserRoleId();

    JsonOutput::success();
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}