<?php
//Вывод пользователя.

use DB\Base\UsersQuery;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\AuthUserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

$request = new Request();

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    $user_id = (new Request())->getQueryOrThrow('user_id');
    $user = UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    UsersTableMap::COL_PHONE,
                    UsersTableMap::COL_EMAIL,
                    UserRoleTableMap::COL_ID,
                    UserRoleTableMap::COL_NAME
                ])
                ->leftJoinUserRole()
                ->filterByIsAvailable(1)
                ->findPk($user_id) ?: throw new Exception('Пользователь не был найден');

    JsonOutput::success([
        'id' => $user['users.id'],
        'username' => $user['users.username'],
        'phone' => $user['users.phone'],
        'email' => $user['users.email'],
        'role' => [
            'id' => $user['user_role.id'],
            'name' => $user['user_role.name'],
        ],
    ]);
} catch (NoAccessManageUsersException $e) {
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Роль не была найдена');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Пользователь не был найден');
} catch (Exception|PropelException $e) {
    JsonOutput::error($e->getMessage());
}