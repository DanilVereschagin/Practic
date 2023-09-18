<?php

declare(strict_types=1);

define('APP_ROOT', __DIR__);
define('ID', 1);

require 'vendor/autoload.php';

use App\Model\Database;
use App\Router\Router;

Database::getInstance();
$requestUri = $_SERVER['REQUEST_URI'] ?? null;
(new Router())->selectController($requestUri);
