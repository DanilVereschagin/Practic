<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Factory\CacheFactory;

class CacheMiddleware implements MiddlewareInterface
{
    protected MiddlewareInterface $next;

    public function setNext(MiddlewareInterface $handle)
    {
        $this->next = $handle;
    }

    public function getNext()
    {
        return $this->next ?? null;
    }

    public function handle(string $url)
    {
        $cacheFactory = new CacheFactory();
        $cacheService = $cacheFactory->create();

        if ($cache = $cacheService->get($url)) {
            header('Content-Type: application/json');
            echo $cache;
            exit;
        }
    }
}
