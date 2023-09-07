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

        $route = mb_substr($route, 1);
        $route = explode('/', $route);

        $class = $controllerMap['/' . $route[0]] ?? null;

        if ($class) {
            /** @var AbstractController $controller */
            $controller = new IndexController();
            $controller->execute();
        } else {
            (new NotFoundErrorController())->execute();
            $controller = new $class();
            $controller->{$route[1]}();
        }
    }
}
