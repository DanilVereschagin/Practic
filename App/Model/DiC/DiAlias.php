<?php

declare(strict_types=1);

namespace App\Model\DiC;

use App\Model\Environment;
use App\Model\Service\FileCacheService;
use App\Model\Service\PredisCacheService;
use Laminas\Di\Di;

class DiAlias
{
    protected $di;
    protected $instanceManager;

    public function __construct(Di $di)
    {
        $this->di = $di;
        $this->instanceManager = $di->instanceManager();
    }

    public function assemble()
    {
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if (strpos($method->getName(), 'assemble') == 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }

    protected function assembleAliasCache()
    {
        $cacheType = Environment::getCacheSetting('TYPE');

        $this->instanceManager->addAlias(
            'alias_cache',
            $cacheType === 'file' ? FileCacheService::class : PredisCacheService::class
        );
    }
}
