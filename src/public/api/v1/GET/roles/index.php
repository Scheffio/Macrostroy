<?php
//Вывод ролей.

use DB\Base\UserRoleQuery;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    JsonOutput::success(
        UserRoleQuery::create()
            ->select(['id', 'name'])
            ->find()
            ->getData()
    );
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Роль не была найдена');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Пользователь не найден');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}