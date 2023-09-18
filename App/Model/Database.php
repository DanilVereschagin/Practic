<?php

declare(strict_types=1);

namespace App\Model;

class Database
{
    protected static $_instance;

    private function __construct()
    {
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


        self::$_instance = new \PDO($dsn, $user, $pass, $opt);
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            new self();
        }

        return self::$_instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
