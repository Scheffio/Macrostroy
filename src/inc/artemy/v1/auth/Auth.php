<?php

namespace inc\artemy\v1\auth;


use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\mysql\Mysql;
use inc\artemy\v1\router\Router;
use MysqlCredentials\MysqlCredentials;

final class Auth extends \Delight\Auth\Auth
{
    private static Auth $auth;

    public static function getUser(): Auth
    {
        if (isset(self::$auth)) return self::$auth;

        self::$auth = new self(MysqlCredentials::getPDO(), $_SERVER['REMOTE_ADDR']);
        return self::$auth;
    }

    public static function getUserOrThrow(): Auth
    {
        if (isset(self::$auth)) return self::$auth;

        self::$auth = new self(MysqlCredentials::getPDO(), $_SERVER['REMOTE_ADDR']);

        if (!self::$auth->isLoggedIn()) {
            if (Router::isApi()) {
                JsonOutput::instruction(["goto" => "/login/"]);
            }

            if (Router::isPage()) {
                header("Location: /login/");
            }
        }
        return self::$auth;
    }
}