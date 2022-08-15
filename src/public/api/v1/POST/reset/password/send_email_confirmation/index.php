<?php

//SETTINGS
use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\ResetDisabledException;
use Delight\Auth\TooManyRequestsException;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request_expires_after = 60 * 30;
if (DevelopmentMode::isActive()) {
    $max_open_requests = 500;
} else {
    $max_open_requests = 5;
}
$domain = $_SERVER['HTTP_HOST'];
$https = "https://";
$auth = Auth::getUser();


$request = new Request();
$request->checkRequestVariablesStrictNoNullOrError("user_email");

try {
    $recovery_link = "";
    $auth->forgotPassword($_POST['user_email'], function ($selector, $token) use ($https, $domain, &$recovery_link) {
        $link = $https . $domain . '/auth/reset_password/change_password?selector=' . urlencode($selector) . '&token=' . urlencode
            ($token);
        $recovery_link = $link;
        MailSender::sendPasswordChange($_POST['user_email'], $link);
    },                    $request_expires_after, $max_open_requests);
    if (DevelopmentMode::isActive()) {
        JsonOutput::success(["___WILL_BE_HIDDEN_LATER___email_recovery_link" => $recovery_link]);
    } else {
        JsonOutput::success();
    }
} catch (InvalidEmailException $e) {
    JsonOutput::error("Указанная Вами почта не найдена. Пожалуйста, проверьте правильность написания.");
} catch (EmailNotVerifiedException $e) {
    JsonOutput::error("Почта не подтверждена.");
} catch (ResetDisabledException $e) {
    JsonOutput::error("Невозможно восстановить пароль. Функция отключена.");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов! Подождите немного и попробуйте ещё.");
}