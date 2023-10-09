<?php

declare(strict_types=1);

namespace App\Model\Cache;

interface CacheMiddlewareInterface
{
    public function setNext(CacheMiddlewareInterface $handle);

    public function getNext();

    public function handle(string $type);

    public function getPlayersCache();

    public function getGamesCache();

    public function updatePlayersCache();

    public function updateGamesCache();

    public function deletePlayersCache();

    public function deleteGamesCache();
}
