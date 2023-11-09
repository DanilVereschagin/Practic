<?php

declare(strict_types=1);

namespace App\Model\DiC;

use Laminas\Di\Di;
use Psr\SimpleCache\CacheInterface;

class DiCaches
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
        $this->instanceManager->addTypePreference(
            CacheInterface::class,
            'alias_cache'
        );
    }
}
