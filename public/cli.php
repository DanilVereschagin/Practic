<?php

declare(strict_types=1);

define('APP_ROOT', __DIR__ . '/..');
require APP_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\Environment;
use App\Model\Service\LoggerService;
use App\Model\Service\WebApiSevice\SendinBlueApiService;
use App\Router\CliRouter;

$db = Database::getInstance();
$en = Environment::getInstance();
$log = LoggerService::getInstance();
SendinBlueApiService::getInstance();

$router = new CliRouter();
try {
    $router->selectConsoleCommand();
} catch (\App\Model\Exception\ConsoleCommandException $exception) {
    $log->warning('Cli', [$exception->getMessage()]);
    $log->error('Cli', [$exception->getMessage()]);
    exit($exception->getMessage());
}
