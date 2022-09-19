<?php
// Удаление роли.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

$request = new Request();

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    $role_id = $request->getQueryOrThrow('role_id');

    if ($role_id === 1) throw new Exception('Невозможно удалить роль по умолчанию');

    AuthUserRole::getUserRoleObj()->setRoleId($role_id)->delete();

    JsonOutput::success();
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (Exception|PropelException $e) {
    JsonOutput::error($e->getMessage());
}