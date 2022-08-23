<?php

use DB\UsersQuery;
use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\email_sender\MailSender;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();
Auth::getUser()->register($request->getRequest("user_email"), Auth::createUuid(), null, function () {

});