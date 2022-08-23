<?php
//Вывод пользователей.

use DB\Base\UsersQuery;
use DB\Map\UsersTableMap;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    if (empty($_GET)) {
        JsonOutput::success(
            UsersQuery::create()
                ->select(['id', 'username'])
                ->find()
                ->getData()
        );
    }

    $request = new Request();
    $user_id = $request->getQueryOrThrow('user_id');
    $project_id = $request->getQueryOrThrow('project_id');
    $object_id = $request->getQueryOrThrow('object_id');
    $object_name = $request->getQueryOrThrow('object_name');


} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}