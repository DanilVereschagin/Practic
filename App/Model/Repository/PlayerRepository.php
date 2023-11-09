<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Factory\CacheFactory;
use App\Factory\ResourceFactory;
use App\Factory\ServiceFactory;
use App\Model\Resource\PlayerResource;
use App\Model\Service\PasswordService;
use Laminas\Di\Di;
use Psr\SimpleCache\CacheInterface;

class PlayerRepository extends AbstractRepository
{
    protected CacheInterface $cacheService;
    protected $resourceFactory;
    protected $serviceFactory;

    public function __construct(
        CacheInterface $cacheService,
        Di $di,
        ResourceFactory $resourceFactory,
        ServiceFactory $serviceFactory
    ) {
        $this->cacheService = $cacheService;
        $this->di = $di;
        $this->resourceFactory = $resourceFactory;
        $this->serviceFactory = $serviceFactory;
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

    public function setDefaultValues(array $data): array
    {
        $data['date_of_registration'] = date('Y-m-d h:i:s');
        $data['is_admin'] = 0;
        $data['fake_hour'] = 0;
        $password = $this->serviceFactory->create('password', ['di' => $this->di]);
        $data['password'] = $password->hashPassword($data['password']);
        return $data;
    }

    public function getAll()
    {
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        return $resource->getAllPlayers();
    }
}
