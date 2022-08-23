<?php
//Вывод ролей.

use DB\Base\RoleQuery;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    JsonOutput::success(
        RoleQuery::create()
            ->select(['id', 'name'])
            ->find()
            ->getData()
    );
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}