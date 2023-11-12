<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Resource\EnvironmentResource;
use Laminas\Di\Di;

class Environment
{
    protected $instance;
    protected $sectionDb = 'db';
    protected $sectionCache = 'cache';
    protected $sectionMail = 'mail';

    public function __construct(EnvironmentResource $environmentResource)
    {
        $this->instance = $environmentResource->parseEnvFile(APP_ROOT . '/.env');
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function getDbSetting(string $setting)
    {
        return $this->getInstance()[$this->sectionDb][$setting] ?? null;
    }

    public function getCacheSetting(string $setting)
    {
        return $this->getInstance()[$this->sectionCache][$setting] ?? null;
    }

    public function getMailSetting(string $setting)
    {
        return $this->getInstance()[$this->sectionMail][$setting] ?? null;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
