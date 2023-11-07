<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\SimpleCache\CacheInterface;

class CacheMiddleware implements MiddlewareInterface
{
    protected MiddlewareInterface $next;
    protected $cacheService;

    public function __construct(CacheInterface $cacheService)
    {
        $this->cacheService = $cacheService;
    }

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
        if ($cache = $this->cacheService->get($url)) {
            header('Content-Type: application/json');
            echo json_encode($cache);
            exit;
        }
    }
}
