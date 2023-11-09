<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Resource\EnvironmentResource;
use Laminas\Di\Di;

class Environment
{
    protected static $_instance;
    protected static $sectionDb = 'db';
    protected static $sectionCache = 'cache';
    protected static $sectionMail = 'mail';

    private function __construct(Di $di = null)
    {
        if ($di) {
            $resource = $di->get(EnvironmentResource::class, ['di' => $di]);
        } else {
            $resource = new EnvironmentResource();
        }

        self::$_instance = $resource->parseEnvFile(APP_ROOT . '/.env');
    }

    public static function getInstance(Di $di = null)
    {
        if (self::$_instance === null) {
            new self($di);
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

    public static function getMailSetting(string $setting)
    {
        return self::getInstance()[self::$sectionMail][$setting] ?? null;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
