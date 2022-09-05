<?php
// Добавление роли.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $user->isManageUsersOrThrow();

    $request->checkRequestVariablesOrError(
        'role_name', 'object_viewer', 'manage_objects', 'manage_volumes', 'manage_history', 'manage_users'
    );

    JsonOutput::success(
        $user
            ->setRoleName($request->getRequest("role_name"))
            ->setObjectViewer($request->getRequest("object_viewer"))
            ->setManageObjects($request->getRequest("manage_objects"))
            ->setManageVolumes($request->getRequest("manage_volumes"))
            ->setManageHistory($request->getRequest("manage_history"))
            ->setManageUsers($request->getRequest("manage_users"))
            ->add()
            ->getRoleId()
    );

} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}