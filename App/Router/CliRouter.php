<?php

declare(strict_types=1);

namespace App\Router;

use App\Middleware\ConsoleCommandMiddleware;
use App\Model\Exception\ConsoleCommandException;

class CliRouter
{
    protected $cliRoutes;

    public function __construct(array $cliRoutes)
    {
        $this->cliRoutes = $cliRoutes;
    }

    public function selectConsoleCommand()
    {
        $consoleCommand = new ConsoleCommandMiddleware();
        $consoleCommand->handle('argv');

        $argument = $_SERVER['argv'][1];
        $class = $this->cliRoutes[$argument] ?? null;

        if ($class) {
            $consoleCommand = new $class();
            return;
        }

        throw new ConsoleCommandException('incorrect console command');
    }
}
