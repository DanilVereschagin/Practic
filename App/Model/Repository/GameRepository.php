<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Factory\CacheFactory;
use App\Factory\ResourceFactory;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;
use Psr\SimpleCache\CacheInterface;

class GameRepository extends AbstractRepository
{
    protected CacheInterface $cacheService;
    protected $resourceFactory;

    public function __construct(CacheInterface $cacheService, Di $di, ResourceFactory $resourceFactory)
    {
        $this->cacheService = $cacheService;
        $this->di = $di;
        $this->resourceFactory = $resourceFactory;
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
        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
        return $resource->getAll();
    }
}
