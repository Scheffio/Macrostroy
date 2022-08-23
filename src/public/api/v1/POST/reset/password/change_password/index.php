<?php


use Delight\Auth\InvalidPasswordException;
use Delight\Auth\InvalidSelectorTokenPairException;
use Delight\Auth\ResetDisabledException;
use Delight\Auth\TokenExpiredException;
use Delight\Auth\TooManyRequestsException;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$throttling = !DevelopmentMode::isActive();
$request = new Request();
$request->checkRequestVariablesStrictOrError("selector", "token", "password");
$selector = $request->getRequest("selector");
$token = $request->getRequest("token");
$password = $request->getRequest("password");
$auth = Auth::getUser();

try {
    $auth->resetPassword($selector, $token, $password);

    JsonOutput::success();
} catch (InvalidSelectorTokenPairException $e) {
    JsonOutput::error('Неверный токен. Попробуйте восстановить пароль ещё раз.');
} catch (TokenExpiredException $e) {
    JsonOutput::error('Срок действия токена истёк. Попробуйте восстановить пароль ещё раз.');
} catch (ResetDisabledException $e) {
    JsonOutput::error('Password reset is disabled');
} catch (InvalidPasswordException $e) {
    JsonOutput::error('Invalid password');
} catch (TooManyRequestsException $e) {
    JsonOutput::error('Too many requests');
}