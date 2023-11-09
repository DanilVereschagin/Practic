<?php

declare(strict_types=1);

define('APP_ROOT', __DIR__ . '/..');
require APP_ROOT . '/vendor/autoload.php';

use App\Model\DiC\DiContainer;
use App\Model\Service\LoggerService;
use App\Router\CliRouter;
use Laminas\Di\Di;


$log = LoggerService::getInstance();

$di = new Di();
$dic = new DiContainer($di);
$dic->assemble();

$router = $di->get(CliRouter::class);
try {
    $router->selectConsoleCommand();
} catch (\App\Model\Exception\ConsoleCommandException $exception) {
    $log->warning('Cli', [$exception->getMessage()]);
    $log->error('Cli', [$exception->getMessage()]);
    exit($exception->getMessage());
}
