<?php
//на выбор 3 функции

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\json_output\JsonOutput;

$auth = Auth::getUserOrThrow();

$auth->logOut();

////выйди везде кроме этой сессии
//try {
//    $auth->logOutEverywhereElse();
//}
//catch (\Delight\Auth\NotLoggedInException $e) {
//    die('Not logged in');
//}
////выйти везде
//try {
//    $auth->logOutEverywhere();
//}
//catch (\Delight\Auth\NotLoggedInException $e) {
//    die('Not logged in');
//}
$auth->destroySession();

JsonOutput::success();