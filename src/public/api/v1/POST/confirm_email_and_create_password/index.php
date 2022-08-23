<?php
$request = new \inc\artemy\v1\request\Request();
$request->checkRequestVariablesStrictOrError("selector", "token", "password");
$user_id = \DB\UsersConfirmationsQuery::create()->findOneBySelector($request->getQuery("selector"));
try {
    \inc\artemy\v1\auth\Auth::getUser()->confirmEmail($request->getQuery("selector"), $request->getQuery("token"));
    \inc\artemy\v1\auth\Auth::getUser()->admin()->changePasswordForUserById($user_id, $request->getRequest("password"));
} catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Неверная связка ключ-токен");
} catch (\Delight\Auth\TokenExpiredException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Время токена истекло");
} catch (\Delight\Auth\TooManyRequestsException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Слишком много запросов");
} catch (\Delight\Auth\UserAlreadyExistsException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Пользователь уже существует");
} catch (\Delight\Auth\InvalidPasswordException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Неверный пароль");
} catch (\Delight\Auth\UnknownIdException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error("Пользователь не существует");
}