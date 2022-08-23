<?php

use DB\UsersThrottlingQuery;
use inc\artemy\v1\development_mode\DevelopmentMode;
use Propel\Runtime\Exception\PropelException;

DevelopmentMode::clearUsersThrottling();

//SETTINGS
$id = \inc\artemy\v1\auth\Auth::getUser()->register($_POST["user_email"], $_POST["user_password"]);

\DB\UsersQuery::create()->findOneById($id)->setRoleId(5)->save();