<?php
// Добавление роли.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    JsonOutput::success(
        $user
            ->setRoleName($request->getRequestOrThrow("role_name"))
            ->setAccessObjectViewer(false)
            ->setAccessManageObjects(false)
            ->setAccessManageVolumes(false)
            ->setAccessManageHistory(false)
            ->setAccessManageUsers(false)
            ->add()
            ->getRoleId()
    );

} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}