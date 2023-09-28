<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\NotFoundErrorController;
use App\Model\AuthCheckMiddleware;
use App\Model\HttpMethodNotAllowedException;
use App\Model\HttpRedirectException;
use App\Model\Session;
use App\Model\SessionObserver;

class Router
{
    public function selectController(string $route)
    {
        $controllerMap = require APP_ROOT . '/etc/routes.php';

        if ($queryPos = stripos($route, '?')) {
            $route = substr($route, 0, $queryPos);
        }

        $class = $controllerMap[$route] ?? null;

        if ($class) {
            try {
                $authchecker = new AuthCheckMiddleware();
                $authchecker->checkAuth($route);
                /** @var AbstractController $controller */
                $controller = new $class();
                $controller->execute();
            } catch (HttpRedirectException $e) {
                header('Location: ' . $e->getMessage(), true, 302);
                return;
            } catch (HttpMethodNotAllowedException $e) {
                http_response_code(405);
                return;
            }
        }

        $controller = new NotFoundErrorController();
        $controller->execute();
    }
}
