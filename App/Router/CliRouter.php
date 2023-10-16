<?php

declare(strict_types=1);

namespace App\Router;

class CliRouter
{
    public function selectConsoleCommand()
    {
        $consoleMap = require APP_ROOT . '/etc/ConsoleRoutes.php';

        $argument = $_SERVER['argv'][1];
        $class = $consoleMap[$argument] ?? null;

        if ($class) {
            $consoleCommand = new $class();
        }
    }
}
