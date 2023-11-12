<?php

declare(strict_types=1);

namespace App\Model;

class Database
{
    protected $connection;

    public function __construct(Environment $environment)
    {
        $host = $environment->getDbSetting('HOST');
        $db   = $environment->getDbSetting('DB');
        $user = $environment->getDbSetting('USER');
        $pass = $environment->getDbSetting('PASS');
        $charset = $environment->getDbSetting('CHARSET');

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->connection = new \PDO($dsn, $user, $pass, $opt);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
