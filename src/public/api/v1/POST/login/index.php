<?php

//SETTINGS
use Delight\Auth\AttemptCancelledException;
use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;


$throttling = !DevelopmentMode::isActive();
$rememberDuration = (int)(60 * 60 * 24 * 365.25);
$auth = Auth::getUser();

$request = new Request();
$request->checkRequestVariablesStrictOrError("user_email", "user_password");
try {
    $auth->login($request->getRequest("user_email"), $request->getRequest("user_password"), $rememberDuration);
    JsonOutput::success();

} catch (InvalidEmailException $e) {
    JsonOutput::error("Пользователь с такой почтой не найден. Пожалуйста, проверьте правильность написания почты.");
} catch (InvalidPasswordException $e) {
    JsonOutput::error("Неправильно введён пароль. Пожалуйста, проверьте правильность написания пароля.");
} catch (EmailNotVerifiedException $e) {
    JsonOutput::error("Почта не подтверждена");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (AttemptCancelledException $e) {
    JsonOutput::error("Попытка отменена");
}