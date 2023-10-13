<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Resource\EnvironmentResource;

class Environment
{
    protected static $_instance;
    protected static $sectionDb = 'db';
    protected static $sectionCache = 'cache';

    private function __construct(?string $path = APP_ROOT)
    {
        $resource = new EnvironmentResource();
        self::$_instance = $resource->parseEnvFile($path . '/.env');
    }

    public static function getInstance(?string $path = null)
    {
        if (self::$_instance === null) {
            if ($path == null) {
                $path = APP_ROOT;
            }
            new self($path);
        }

        return self::$_instance;
    }

    public static function getDbSetting(string $setting)
    {
        return self::getInstance()[self::$sectionDb][$setting] ?? null;
    }

    public static function getCacheSetting(string $setting)
    {
        return self::getInstance()[self::$sectionCache][$setting] ?? null;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
