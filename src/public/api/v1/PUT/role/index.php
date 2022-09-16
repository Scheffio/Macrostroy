<?php
// Редактирование роли.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    AuthUserRole::isAccessManageUsers();

    $role_id = $request->getQueryOrThrow('role_id');
    $role_name = $request->getQuery('role_name');
    $object_viewer = $request->getQuery('object_viewer');
    $manage_objects = $request->getQuery('manage_objects');
    $manage_volumes = $request->getQuery('manage_volumes');
    $manage_history = $request->getQuery('manage_history');
    $manage_users = $request->getQuery('manage_users');

    $user
        ->setRoleId($role_id)
        ->setRoleName($role_name)
        ->setAccessObjectViewer($object_viewer)
        ->setAccessManageObjects($manage_objects)
        ->setAccessManageVolumes($manage_volumes)
        ->setAccessManageHistory($manage_history)
        ->setAccessManageUsers($manage_users)
        ->update();

    JsonOutput::success();
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::success('Неизвестный пользователь');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}