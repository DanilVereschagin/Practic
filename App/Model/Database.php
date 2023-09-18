<?php

declare(strict_types=1);

namespace App\Model;

class Database
{
    protected static $_instance;

    private function __construct()
    {
        $settings = Environment::getInstance();

        $host = $settings['db']['HOST'];
        $db   = $settings['db']['DB'];
        $user = $settings['db']['USER'];
        $pass = $settings['db']['PASS'];
        $charset = $settings['db']['CHARSET'];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
        self::$_instance = new \PDO($dsn, $user, $pass, $opt);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
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
