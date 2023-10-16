<?php

declare(strict_types=1);

use App\Model\Database;
use App\Model\Environment;
use App\Router\CliRouter;

define('APP_ROOT', __DIR__ . '/..');

require APP_ROOT . '/vendor/autoload.php';

$db = Database::getInstance();
$en = Environment::getInstance();

$router = new CliRouter();
$router->selectConsoleCommand();
