<?php

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\user_role\UserRole;

try {
    UserRole::getByUserId()->isManageUsersOrThrow(); //спасибо лера
} catch (Exception $e) {
    JsonOutput::error("Роль не роль иди домой");
}


$request = new Request();
$request->checkRequestVariables("user_nickname", "user_email", "user_role_id");


if (!empty($request->getRequest("user_nickname"))) {
    $username = $request->getRequest("user_nickname");
} else {
    $request->checkRequestVariablesOrError("user_name", "user_surname", "user_patronymic");
    $username = $request->getRequest("user_surname") . " " . $request->getRequest("user_name") . " " . $request->getRequest("user_patronymic");
}
try {
    $id = Auth::getUser()->register($request->getRequest("user_email"), Auth::createUuid(), $username, function ($selector, $token)
    use ($request) {
        $link = "https://" . $_SERVER['HTTP_HOST'] . '/auth/create_account?selector=' . urlencode
            ($selector) . '&token=' . urlencode
            ($token);
        MailSender::sendAccountCreatedByAdmin($request->getRequest("user_email"), $link);
    });

    JsonOutput::success([
                            "id" => $id,
                            "username" => $username
                        ]);
} catch (\Delight\Auth\InvalidEmailException $e) {
    JsonOutput::error("Неверная почта");
} catch (\Delight\Auth\InvalidPasswordException $e) {
    JsonOutput::error("Неправильный пароль");
} catch (\Delight\Auth\TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (\Delight\Auth\UserAlreadyExistsException $e) {
    JsonOutput::error("Пользователь с этой почтой уже существует");
}
