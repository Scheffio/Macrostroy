<?php
//Вывод роли.

use DB\Base\UserRoleQuery;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    $role_id = (new Request())->getQueryOrThrow('role_id');

    $role = UserRoleQuery::create()->findPk($role_id)->toArray(TableMap::TYPE_FIELDNAME)
            ?: throw new Error('No role found');

    JsonOutput::success($role);
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Роль не была найдена');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Пользователь не был найден');
} catch (Exception|PropelException $e) {
    JsonOutput::error($e->getMessage());
}