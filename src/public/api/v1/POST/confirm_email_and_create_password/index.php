<?php
$request = new \inc\artemy\v1\request\Request();
$request->checkRequestVariablesStrictOrError("selector", "token", "password");
$user_confirmation = \DB\UsersConfirmationsQuery::create()->findOneBySelector($request->getRequest("selector"));
if ($user_confirmation === null) \inc\artemy\v1\json_output\JsonOutput::error();
try {
    \inc\artemy\v1\auth\Auth::getUser()->confirmEmail($request->getRequest("selector"), $request->getRequest("token"));
    \inc\artemy\v1\auth\Auth::getUser()->admin()->changePasswordForUserById($user_confirmation->getUserId(),
                                                                            $request->getRequest("password"));
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

\inc\artemy\v1\json_output\JsonOutput::success();