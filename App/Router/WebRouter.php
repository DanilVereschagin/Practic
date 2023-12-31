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
    protected $log;

    public function __construct(Di $di, LoggerService $loggerService, array $routes = [])
    {
        $this->di = $di;
        $this->routes = $routes;
        $this->log = $loggerService;
    }

    public function selectController(string $route)
    {
        if ($queryPos = stripos($route, '?')) {
            $route = substr($route, 0, $queryPos);
        }

        $class = $this->routes[$route] ?? null;

        if ($class) {
            try {
                $authchecker = $this->di->get(AuthCheckMiddleware::class);
                $authchecker->handle($route);
                /** @var AbstractController $controller */
                $controller = $this->di->get($class, ['di' => $this->di]);
                $controller->execute();
                return;
            } catch (HttpRedirectException $e) {
                header('Location: ' . $e->getMessage(), true, 302);
                $this->log->warning('Web', [$e->getMessage()]);
                return;
            } catch (HttpMethodNotAllowedException $e) {
                http_response_code(405);
                $this->log->error('Web', [$e->getMessage()]);
                return;
            }
        }

        $controller = $this->di->get(NotFoundErrorController::class);
        $controller->execute();
    }
}
