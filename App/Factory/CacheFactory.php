<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Environment;
use App\Model\Service\FileCacheService;
use App\Model\Service\PredisCacheService;

class CacheFactory
{
    public function create()
    {
        $cacheType = Environment::getCacheSetting('TYPE');

        switch ($cacheType) {
            case 'file':
                return new FileCacheService();
            default:
                return new PredisCacheService();
        }
    }
}
