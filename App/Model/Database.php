<?php

declare(strict_types=1);

namespace App\Model;

class Database
{
    protected static $_instance;
    protected static $section = "db";

    private function __construct()
    {
        $host = Environment::getSetting(self::$section, "HOST");
        $db   = Environment::getSetting(self::$section, "DB");
        $user = Environment::getSetting(self::$section, "USER");
        $pass = Environment::getSetting(self::$section, "PASS");
        $charset = Environment::getSetting(self::$section, "CHARSET");

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
