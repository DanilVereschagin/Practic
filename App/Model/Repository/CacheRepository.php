<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Factory\CacheFactory;
use Psr\SimpleCache\CacheInterface;

class CacheRepository
{
    protected CacheInterface $cacheService;

    public function __construct()
    {
        $cacheFactory = new CacheFactory();
        $this->cacheService = $cacheFactory->create();
    }

    public function get(string $url)
    {
        return $this->cacheService->get($url);
    }

    public function set(string $url, $data)
    {
        $this->cacheService->set($url, $data);
    }

    public function update(string $url, $data)
    {
        $this->cacheService->delete($url);
        $this->cacheService->set($url, $data);
    }

    public function delete(string $url)
    {
        $this->cacheService->delete($url);
    }
}