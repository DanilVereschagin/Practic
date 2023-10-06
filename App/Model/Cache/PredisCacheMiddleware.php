<?php

declare(strict_types=1);

namespace App\Model\Cache;

class PredisCacheMiddleware implements CacheMiddlewareInterface
{
    protected CacheMiddlewareInterface $next;
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
        if ($this->getNext()) {
            return $this->getNext()->handle($type);
        }

        return null;
    }

    public function getPlayersCache()
    {
        // TODO: Implement getPlayersCache() method.
    }
}
