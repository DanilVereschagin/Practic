<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\Web\NotFoundErrorController;
use App\Model\Exception\HttpMethodNotAllowedException;
use App\Model\Exception\HttpRedirectException;
use App\Model\Service\LoggerService;
use Laminas\Di\Di;

class ApiRouter
{
    protected $apiRoutes;
    protected $di;

    public function __construct(Di $di, array $apiRoutes = [])
    {
        $this->di = $di;
        $this->apiRoutes = $apiRoutes;
    }

    public function selectController(string $route)
    {
        $log = LoggerService::getInstance();

        $routeParts = explode('/', $route);

        $route = '/' . $routeParts[2];

        $class = $this->apiRoutes[$route] ?? null;

        if ($class) {
            try {
                /** @var AbstractController $controller */
                $controller = $this->di->get($class, ['di' => $this->di]);
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

        $controller = $this->di->get(NotFoundErrorController::class);
        $controller->execute();
    }
}
