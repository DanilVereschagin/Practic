<?php

declare(strict_types=1);

namespace App\Model\Cache;

use App\Model\Resource\GameResource;
use App\Model\Resource\PlayerResource;
use Predis\Client;

class PredisCacheMiddleware implements CacheMiddlewareInterface
{
    protected CacheMiddlewareInterface $next;
    protected Client $redis;
    protected string $cacheType = 'predis';
    protected string $players = 'players';
    protected string $games = 'games';

    public function __construct()
    {
        $this->redis = new Client();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function setNext(CacheMiddlewareInterface $handle)
    {
        $this->next = $handle;
    }

    public function getNext()
    {
        return $this->next ?? null;
    }

    public function handle(string $type)
    {
        if ($type !== $this->cacheType) {
            if ($this->getNext()) {
                return $this->getNext()->handle($type);
            }

            return null;
        }

        return $this;
    }

    public function getPlayersCache()
    {

        if ($cacheData = $this->redis->get($this->players)) {
            return json_decode($cacheData, true);
        }

        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        $this->redis->set($this->players, json_encode($players));

        return $players;
    }

    public function getGamesCache()
    {
        if ($cacheData = $this->redis->get($this->games)) {
            return json_decode($cacheData, true);
        }

        $resource = new GameResource();
        $games = $resource->getAll();

        $this->redis->set($this->games, json_encode($games));

        return $games;
    }

    public function updatePlayersCache()
    {
        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        $this->redis->set($this->players, json_encode($players));
    }

    public function updateGameCache()
    {
        $resource = new GameResource();
        $games = $resource->getAll();

        $this->redis->set($this->games, json_encode($games));
    }
}
