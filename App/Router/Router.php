<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\IndexController;
use App\Controller\NotFoundErrorController;

class Router
{
    public function selectController(string $route)
    {
        $controllerMap = require APP_ROOT . '/etc/routes.php';

        $class = $controllerMap[$route] ?? null;

        if ($class) {
            /** @var AbstractController $controller */
            $controller = new $class();
            $controller->execute();
        } else {
            (new NotFoundErrorController())->execute();
        }
    }
}
