<?php
//Вывод пользователей.

use DB\Base\UsersQuery;
use DB\Map\UsersTableMap;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    JsonOutput::success(
        UsersQuery::create()
            ->select(['id', 'username'])
            ->find()
            ->getData()
    );
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}