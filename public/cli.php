<?php

declare(strict_types=1);

define('APP_ROOT', __DIR__ . '/..');
require APP_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\Environment;
use App\Model\Service\LoggerService;
use App\Router\CliRouter;

$db = Database::getInstance();
$en = Environment::getInstance();
$log = LoggerService::getInstance();

$router = new CliRouter();
try {
    $router->selectConsoleCommand();
} catch (\App\Model\Exception\ConsoleCommandException $exception) {
    $log->warning('Cli');
    $log->error('Cli');
    exit($exception->getMessage());
}
