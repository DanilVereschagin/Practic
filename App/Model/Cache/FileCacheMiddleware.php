<?php

declare(strict_types=1);

namespace App\Model\Cache;

use App\Model\Resource\GameResource;
use App\Model\Resource\PlayerResource;

class FileCacheMiddleware
{
    protected string $players = 'players.json';
    protected string $games = 'games.json';

    public function getPlayersCache()
    {
        $cacheFile = APP_ROOT . '/var/cache/' . $this->players;

        if ($cacheData = file_get_contents($cacheFile)) {
            return json_decode($cacheData, true);
        }

        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        file_put_contents($cacheFile, json_encode($players));

        return $players;
    }

    public function getGamesCache()
    {
        $cacheFile = APP_ROOT . '/var/cache/' . $this->games;

        if ($cacheData = file_get_contents($cacheFile)) {
            return json_decode($cacheData, true);
        }

        $resource = new GameResource();
        $games = $resource->getAll();

        file_put_contents($cacheFile, json_encode($games));

        return $games;
    }

    public function updatePlayersCache()
    {
        $cacheFile = APP_ROOT . '/var/cache/' . $this->players;

        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        file_put_contents($cacheFile, json_encode($players));
    }

    public function updateGameCache()
    {
        $cacheFile = APP_ROOT . '/var/cache/' . $this->games;

        $resource = new GameResource();
        $games = $resource->getAll();

        file_put_contents($cacheFile, json_encode($games));
    }
}
