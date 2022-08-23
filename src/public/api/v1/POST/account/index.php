<?php

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\request\Request;

$request = new Request();

$auth = Auth::getUserOrThrow();
$user = \DB\UsersQuery::create()->findOneById($auth->id());
if (!empty($request->getRequest("user_phone"))) {
    $user->setPhone($request->getRequest("user_phone"));
    try {
        $user->save();
    } catch (\Propel\Runtime\Exception\PropelException $e) {
        \inc\artemy\v1\json_output\JsonOutput::error();
    }
}

if (!empty($request->getRequest("user_password"))) {
    try {
        $auth->changePasswordWithoutOldPassword($request->getRequest("user_password"));
    } catch (\Delight\Auth\InvalidPasswordException|\Delight\Auth\NotLoggedInException $e) {
        \inc\artemy\v1\json_output\JsonOutput::error();
    }
}

\inc\artemy\v1\json_output\JsonOutput::success();