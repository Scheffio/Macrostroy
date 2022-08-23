<?php
//Вывод пользователя.

use DB\Base\UsersQuery;
use DB\Map\UsersTableMap;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    $user = UsersQuery::create()

//    JsonOutput::success(
//        UsersQuery::create()
//            ->select(['id', 'username'])
//            ->find()
//            ->getData()
//    );
} catch (PropelException|Error $e) {
    JsonOutput::error($e->getMessage());
}