<?php
// Присваивание роли пользователю.

use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

$user = new UserRole();
$request = new Request();

try {
    $user->isManageUsersOrThrow();
    $request->checkRequestVariablesOrError('user_id', 'role_id');

    $user
        ->setUserId($request->getRequest("user_id"), false)
        ->setRoleId($request->getRequest("role_id"), false)
        ->updateUserRole();

    JsonOutput::success();
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}