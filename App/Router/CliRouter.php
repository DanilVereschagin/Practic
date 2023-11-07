<?php

declare(strict_types=1);

namespace App\Router;

use App\Middleware\ConsoleCommandMiddleware;
use App\Model\Exception\ConsoleCommandException;
use Laminas\Di\Di;

class CliRouter
{
    protected $cliRoutes;
    protected $di;

    public function __construct(Di $di, array $cliRoutes)
    {
        $this->di = $di;
        $this->cliRoutes = $cliRoutes;
    }

    public function selectConsoleCommand()
    {
        $consoleCommand = new ConsoleCommandMiddleware();
        $consoleCommand->handle('argv');

        $argument = $_SERVER['argv'][1];
        $class = $this->cliRoutes[$argument] ?? null;

        if ($class) {
            $consoleCommand = $this->di->get($class, ['di' => $this->di]);
            return;
        }

        throw new ConsoleCommandException('incorrect console command');
    }
}
