<?php

declare(strict_types=1);

namespace App\Router;

use App\Middleware\ConsoleCommandMiddleware;
use App\Model\Exception\ConsoleCommandException;

class CliRouter
{
    public function selectConsoleCommand()
    {
        $consoleMap = require APP_ROOT . '/etc/ConsoleRoutes.php';

        $consoleCommand = new ConsoleCommandMiddleware();
        $consoleCommand->handle('argv');

        $argument = $_SERVER['argv'][1];
        $class = $consoleMap[$argument] ?? null;

        if ($class) {
            $consoleCommand = new $class();
        }

        throw new ConsoleCommandException('incorrect console command');
    }
}
