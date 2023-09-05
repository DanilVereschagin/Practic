<?php

declare(strict_types=1);

define('APP_ROOT', __DIR__);
define('ID', 1);

require 'vendor/autoload.php';

use App\Router\Router;

$requestUri = $_SERVER['REQUEST_URI'] ?? null;
(new Router())->selectController($requestUri);
