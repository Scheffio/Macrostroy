<?php


use DB\RoleQuery;
use DB\UsersQuery;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use Delight\Auth\UserAlreadyExistsException;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\UserRole;

try {
    AuthUserRole::isAccessManageUsersOrThrow(); //спасибо лера
} catch (Exception $e) {
    JsonOutput::error($e);
}


$request = new Request();
$request->checkRequestVariables("user_nickname", "user_email", "user_role_id");

$role = RoleQuery::create()->findOneById($request->getRequest("user_role_id"));
if ($role === null) JsonOutput::error("Неизвестная роль");

if (!empty($request->getRequest("user_nickname"))) {
    $username = $request->getRequest("user_nickname");
} else {
    $request->checkRequestVariablesOrError("user_name", "user_surname", "user_patronymic");
    $username = $request->getRequest("user_surname") . " " . $request->getRequest("user_name") . " " . $request->getRequest("user_patronymic");
}
try {
    $user_id = Auth::getUser()->register($request->getRequest("user_email"), Auth::createUuid(), $username, function ($selector, $token)
    use ($request) {
        $link = "https://" . $_SERVER['HTTP_HOST'] . '/auth/create_account?selector=' . urlencode
            ($selector) . '&token=' . urlencode
                ($token);
        MailSender::sendAccountCreatedByAdmin($request->getRequest("user_email"), $link);
    });

    UsersQuery::create()->findOneById($user_id)->setRole($role)->save();

    JsonOutput::success([
                            "id" => $user_id,
                            "username" => $username
                        ]);
} catch (InvalidEmailException $e) {
    JsonOutput::error("Неверная почта");
} catch (InvalidPasswordException $e) {
    JsonOutput::error("Неправильный пароль");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (UserAlreadyExistsException $e) {
    JsonOutput::error("Пользователь с этой почтой уже существует");
} catch (PropelException $e) {
    JsonOutput::error("Ошибка записи роли в БД");
}
