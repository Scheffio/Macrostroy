<?php

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\UserRole;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
} catch (Exception $e) {
    JsonOutput::error("Нет прав удаление пользователя");
}

$request = new Request();
$request->checkRequestVariablesStrictOrError("user_id");

$user = \DB\UsersQuery::create()->findOneById($request->getRequest("user_id"));
$user->setIsAvailable(false);
try {
    $user->save();
} catch (PropelException $e) {
    JsonOutput::error($e);
}

JsonOutput::success();