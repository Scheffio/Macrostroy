<?php

namespace inc\artemy\v1\mysql;

use MysqlCredentials\MysqlCredentials;
use PDO;

class Mysql
{
    private static PDO|null $pdo = null;

    /**
     * Возвращает PDO соединение. Синглетон.
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        return MysqlCredentials::getPDO();
    }
}