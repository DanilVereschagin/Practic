<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\Web\NotFoundErrorController;
use App\Model\Exception\HttpMethodNotAllowedException;
use App\Model\Exception\HttpRedirectException;
use App\Model\Service\LoggerService;

class ApiRouter
{
    public function selectController(string $route)
    {
        $log = LoggerService::getInstance();

        $controllerMap = require APP_ROOT . '/etc/ApiRoutes.php';

        $routeParts = explode('/', $route);

        $route = '/' . $routeParts[2];

        $class = $controllerMap[$route] ?? null;

        if ($class) {
            try {
                /** @var AbstractController $controller */
                $controller = new $class();
                $controller->execute();
                return;
            } catch (HttpRedirectException $e) {
                header('Location: ' . $e->getMessage(), true, 302);
                $log->warning('Api', [$e->getMessage()]);
                return;
            } catch (HttpMethodNotAllowedException $e) {
                http_response_code(405);
                $log->error('Api', [$e->getMessage()]);
                return;
            }
        }

        $controller = new NotFoundErrorController();
        $controller->execute();
    }
}
