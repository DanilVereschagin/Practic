<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('APP_ROOT', __DIR__ . '/..');

require APP_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\DiContainer;
use App\Model\Service\WebApiSevice\SendinBlueApiService;
use App\Model\Session;
use App\Router\ApiRouter;
use App\Router\WebRouter;
use App\Model\Environment;
use Laminas\Di\Di;


$db = Database::getInstance();
$en = Environment::getInstance();
SendinBlueApiService::getInstance();
Session::getInstance();

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
