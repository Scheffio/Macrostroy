<?php

namespace MysqlCredentials;

use PDO;
use PDOException;

class MysqlCredentials
{
    private static PDO|null $pdo = null;

    public const HOST = '31.31.201.154';
    public const DATABASE = 'macrostroy_db';
    public const USER = 'macrostroy_user';
    public const PASSWORD = '5dM5OeUlsE';
    public const PORT = 3306;
    public const CHARSET = 'utf8';


    /**
     * Возвращает PDO соединение. Синглетон.
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if (is_null(self::$pdo)) {
            self::$pdo = new PDO("mysql:dbname=" . MysqlCredentials::DATABASE . ";host=" . MysqlCredentials::HOST . ";port=" . MysqlCredentials::PORT . ";charset=" . MysqlCredentials::CHARSET, MysqlCredentials::USER, MysqlCredentials::PASSWORD);
            return self::$pdo;
        }

        return self::$pdo;
    }
}