<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\NotFoundErrorController;
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

        Session::start();

        if (Session::getClientId() === null) {
            $observer = new SessionObserver();
            $route = $observer->getGuestPages($route);
        }

        $class = $controllerMap[$route] ?? null;

        if ($class) {
            /** @var AbstractController $controller */
            $controller = new $class();
            try {
                $controller->execute();
            } catch (HttpRedirectException $e) {
                header('Location: ' . $e->getMessage(), true, 302);
            } catch (HttpMethodNotAllowedException $e) {
                http_response_code(405);
            }
        }

        $controller = new NotFoundErrorController();
        $controller->execute();
    }
}
