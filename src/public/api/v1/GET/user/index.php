<?php
//Вывод пользователя.

use DB\Base\UsersQuery;
use DB\Map\RoleTableMap;
use DB\Map\UsersTableMap;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

$request = new Request();

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    $user_id = (new Request())->getQueryOrThrow('user_id');
    $user = UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    UsersTableMap::COL_PHONE,
                    UsersTableMap::COL_EMAIL,
                    RoleTableMap::COL_ID,
                    RoleTableMap::COL_NAME
                ])
                ->leftJoinRole()
                ->filterByIsAvailable(1)
                ->findPk($user_id) ?: throw new Exception('No user found');

    JsonOutput::success([
        'id' => $user['users.id'],
        'username' => $user['users.username'],
        'phone' => $user['users.phone'],
        'email' => $user['users.email'],
        'role' => [
            'id' => $user['role.id'],
            'name' => $user['role.name'],
        ],
    ]);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}