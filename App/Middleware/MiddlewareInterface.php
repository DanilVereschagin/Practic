<?php

declare(strict_types=1);

namespace App\Middleware;

interface MiddlewareInterface
{
    public function setNext(MiddlewareInterface $handle);

    public function getNext();

    public function handle(string $url);
}
