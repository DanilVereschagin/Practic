<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Factory\CacheFactory;
use App\Model\Resource\GameResource;
use Psr\SimpleCache\CacheInterface;

class GameRepository
{
    protected CacheInterface $cacheService;

    public function __construct()
    {
        $cacheFactory = new CacheFactory();
        $this->cacheService = $cacheFactory->create();
    }

    public function initCache(string $url)
    {
        $data = $this->getAll();
        $this->cacheService->set($url, $data);
        return $data;
    }

    public function getCache(string $url)
    {
        return $this->cacheService->get($url);
    }

    public function setCache(string $url, $data)
    {
        $this->cacheService->set($url, $data);
    }

    public function deleteCache(string $url)
    {
        $this->cacheService->delete($url);
    }

    public function getAll()
    {
        $resource = new GameResource();
        return $resource->getAll();
    }
}
