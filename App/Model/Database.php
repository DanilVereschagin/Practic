<?php

declare(strict_types=1);

namespace App\Model;

class Database
{
    protected static $connection;

    public static function getConnection(): \PDO
    {
        if (self::$connection) {
            return self::$connection;
        }

        $host = '127.0.0.1:3308';
        $db   = 'computer_game';
        $user = 'dvereschagin';
        $pass = '654321test';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$connection = new \PDO($dsn, $user, $pass, $opt);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return self::$connection;
    }
}
