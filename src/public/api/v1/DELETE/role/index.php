<?php
// Удаление роли.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $user->isManageUsersOrThrow();

    $user
        ->setRoleId($request->getQueryOrThrow('role_id'), false)
        ->delete();

    JsonOutput::success();
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}