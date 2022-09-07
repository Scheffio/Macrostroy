<?php
// Добавление роли.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $user->applyByUserAuth()->isAccessManageUsersOrThrow();

    $request->checkRequestVariablesOrError(
        'role_name', 'object_viewer', 'manage_objects', 'manage_volumes', 'manage_history', 'manage_users'
    );

    JsonOutput::success(
        $user
            ->setRoleName($request->getRequest("role_name"))
            ->setAccessObjectViewer($request->getRequest("object_viewer"))
            ->setAccessManageObjects($request->getRequest("manage_objects"))
            ->setAccessManageVolumes($request->getRequest("manage_volumes"))
            ->setAccessManageHistory($request->getRequest("manage_history"))
            ->setAccessManageUsers($request->getRequest("manage_users"))
            ->add()
            ->getRoleId()
    );

} catch (NoRoleFoundException $e) {
    JsonOutput::error('Роль не была найдена');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Пользователь не найден');
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}