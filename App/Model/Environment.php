<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Resource\EnvironmentResource;

class Environment
{
    protected static $_instance;
    protected static $sectionDb = "db";

    private function __construct()
    {
        $resource = new EnvironmentResource();
        self::$_instance = $resource->parseEnvFile(APP_ROOT . "/.env");
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            new self();
        }

        return self::$_instance;
    }

    public static function getDbSetting(string $setting)
    {
        return self::getInstance()[self::$sectionDb][$setting] ?? null;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
