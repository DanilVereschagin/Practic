<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\Web\NotFoundErrorController;
use App\Middleware\AuthCheckMiddleware;
use App\Model\Exception\HttpMethodNotAllowedException;
use App\Model\Exception\HttpRedirectException;
use App\Model\Service\LoggerService;
use Laminas\Di\Di;

class WebRouter
{
    protected $routes;
    protected $di;

    public function __construct(Di $di, array $routes = [])
    {
        $this->di = $di;
        $this->routes = $routes;
    }

    public function selectController(string $route)
    {
        $log = LoggerService::getInstance();

        if ($queryPos = stripos($route, '?')) {
            $route = substr($route, 0, $queryPos);
        }

        $class = $this->routes[$route] ?? null;

        if ($class) {
            try {
                $authchecker = new AuthCheckMiddleware();
                $authchecker->handle($route);
                /** @var AbstractController $controller */
                $controller = $this->di->get($class);
                $controller->execute();
                return;
            } catch (HttpRedirectException $e) {
                header('Location: ' . $e->getMessage(), true, 302);
                $log->warning('Web', [$e->getMessage()]);
                return;
            } catch (HttpMethodNotAllowedException $e) {
                http_response_code(405);
                $log->error('Web', [$e->getMessage()]);
                return;
            }
        }

        $controller = new NotFoundErrorController();
        $controller->execute();
    }
}
