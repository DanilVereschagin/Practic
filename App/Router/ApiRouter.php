<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\Web\AbstractController;
use App\Controller\Web\NotFoundErrorController;
use App\Model\AuthCheckMiddleware;
use App\Model\HttpMethodNotAllowedException;
use App\Model\HttpRedirectException;

class ApiRouter
{
    public function selectController(string $route)
    {
        $controllerMap = require APP_ROOT . '/etc/ApiRoutes.php';

        $routeParts = explode('/', $route);

        $route = "/" . $routeParts[2];

        $class = $controllerMap[$route] ?? null;

        if ($class) {
            try {
                $authchecker = new AuthCheckMiddleware();
                $authchecker->handle($route);
                /** @var AbstractController $controller */
                $controller = new $class();
                $controller->execute();
                return;
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