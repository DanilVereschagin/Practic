<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('APP_ROOT', __DIR__);
define('ID', 1);

require 'vendor/autoload.php';

use App\Model\Database;
use App\Model\Session;
use App\Router\Router;
use App\Model\Environment;

$db = Database::getInstance();
$en = Environment::getInstance();
$requestUri = $_SERVER['REQUEST_URI'] ?? null;
(new Router())->selectController($requestUri);
