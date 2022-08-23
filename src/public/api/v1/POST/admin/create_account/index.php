<?php

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();
$password = Auth::createUuid();
if (!empty($request->getRequest("user_nickname"))) {
    $username = $request->getRequest("user_nickname");
} else {
    $request->checkRequestVariablesOrError("user_name", "user_surname", "user_patronymic");
    $username = $request->getRequest("user_surname") . " " . $request->getRequest("user_name") . " " . $request->getRequest("user_patronymic");
}
try {
    $id = Auth::getUser()->register($request->getRequest("user_email"), $password, $username, function ($selector, $token)
    use ($password, $request) {
        $link = "https://" . $_SERVER['HTTP_HOST'] . '/auth/create_account?selector=' . urlencode
            ($selector) . '&token=' . urlencode
            ($token);
        MailSender::sendAccountCreatedByAdmin($request->getRequest("user_email"), $link);
    });
    \DB\UsersQuery::create()->findOneById($id)->set

    JsonOutput::success([
                            "id" => $id
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
