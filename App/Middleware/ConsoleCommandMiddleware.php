<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\Exception\ConsoleCommandException;

class ConsoleCommandMiddleware implements MiddlewareInterface
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
        $isCli = substr(php_sapi_name(), 0, 3) === 'cli';

        if (!$isCli) {
            throw new ConsoleCommandException('Cli executable only');
        }

        $argument = $_SERVER['argv'][1] ?? null;

        if (!$argument) {
            throw new ConsoleCommandException('incorrect console command');
        }
    }
}
