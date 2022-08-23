<?php

use DB\UsersQuery;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();
$request->checkRequestVariablesStrictNoNullOrError("user_email");
$email = $request->getRequest("user_email");

if (UsersQuery::create()->findOneByEmail($email) !== null) JsonOutput::error("User already exists");

if (!empty($_POST["user_nickname"])) {
    $id = Auth::getUser()->register($email, bin2hex(random_bytes(128)), $_POST["user_nickname"]);
    $link = $link = "https://" . $_SERVER['HTTP_HOST'] . "/activate_account?user_email=" . urlencode($email);
    MailSender::send($email, "Активация нового пользователя", $link, $link);
}