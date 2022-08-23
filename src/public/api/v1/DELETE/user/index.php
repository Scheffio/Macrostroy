<?php

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\role\user_role\UserRole;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
} catch (Exception $e) {
    JsonOutput::error("Нет прав удаление пользователя");
}

$request = new \inc\artemy\v1\request\Request();
$request->checkRequestVariablesStrictOrError("user_id");

$user = \DB\UsersQuery::create()->findOneById($request->getRequest("user_id"));
$user->setIsAvailable(false);
try {
    $user->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error($e);
}

JsonOutput::success();