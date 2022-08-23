<?php

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();
try {
    Auth::getUser()->register($request->getRequest("user_email"), Auth::createUuid(), null, function ($selector, $token) use ($request) {
        $link = "https://" . $_SERVER['HTTP_HOST'] . '/auth/reset_password/change_password?selector=' . urlencode($selector) . '&token=' . urlencode
            ($token);
        MailSender::sendAccountCreatedByAdmin($request->getRequest("user_email"), $link);
        var_dump();
    });
} catch (\Delight\Auth\AuthError $e) {
} catch (\Delight\Auth\InvalidEmailException $e) {
    JsonOutput::error("Неверная почта");
} catch (\Delight\Auth\InvalidPasswordException $e) {
    JsonOutput::error("Неправильный пароль");
} catch (\Delight\Auth\TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (\Delight\Auth\UserAlreadyExistsException $e) {
    JsonOutput::error("Пользователь с этой почтой уже существует");
}