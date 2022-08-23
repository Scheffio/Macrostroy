<?php

use DB\UsersThrottlingQuery;
use inc\artemy\v1\development_mode\DevelopmentMode;
use Propel\Runtime\Exception\PropelException;

if (DevelopmentMode::isActive()) {
    try {
        $users_throttling = UsersThrottlingQuery::create()->deleteAll();
        echo "Все троттлинги были сброшены.";
    } catch (PropelException $e) {
        echo "Неудачный сброс троттлингов.";
    }
}