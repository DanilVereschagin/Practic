<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Factory\CacheFactory;
use App\Model\Resource\PlayerResource;
use App\Model\Service\PasswordService;
use Psr\SimpleCache\CacheInterface;

class PlayerRepository
{
    protected CacheInterface $cacheService;

    public function __construct()
    {
        $cacheFactory = new CacheFactory();
        $this->cacheService = $cacheFactory->create();
    }

    public function getCache(string $url)
    {
        return $this->cacheService->get($url);
    }

    public function setCache(string $url)
    {
        $this->cacheService->set($url, $this->getAll());
    }

    public function deleteCache(string $url)
    {
        $this->cacheService->delete($url);
    }

    public function setDefaultValues(array $data): array
    {
        $data['date_of_registration'] = date('Y-m-d h:i:s');
        $data['is_admin'] = 0;
        $data['fake_hour'] = 0;
        $password = new PasswordService();
        $data['password'] = $password->hashPassword($data['password']);
        return $data;
    }

    public function getAll()
    {
        $resource = new PlayerResource();
        return json_encode($resource->getAllPlayers());
    }
}
