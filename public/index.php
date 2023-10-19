<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('APP_ROOT', __DIR__ . '/..');

require APP_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\Session;
use App\Router\ApiRouter;
use App\Router\Router;
use App\Model\Environment;


$db = Database::getInstance();
$en = Environment::getInstance();
Session::getInstance();

$requestUri = $_SERVER['REQUEST_URI'] ?? null;

if (strripos($requestUri, '/api/') !== false) {
    $router = new ApiRouter();
    $router->selectController($requestUri);
} else {
    $router = new Router();
    $router->selectController($requestUri);
}
