<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('APP_ROOT', __DIR__ . '/..');

require APP_ROOT . '/vendor/autoload.php';

use App\Model\DiC\DiContainer;
use App\Router\ApiRouter;
use App\Router\WebRouter;
use Laminas\Di\Di;

$requestUri = $_SERVER['REQUEST_URI'] ?? null;

$di = new Di();
$dic = new DiContainer($di);
$dic->assemble();

if (strripos($requestUri, '/api/') !== false) {
    $router = $di->get(ApiRouter::class);
    $router->selectController($requestUri);
} else {
    $router = $di->get(WebRouter::class);
    $router->selectController($requestUri);
}
