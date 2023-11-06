<?php

declare(strict_types=1);

namespace App\Model;

use App\Router\ApiRouter;
use App\Router\CliRouter;
use App\Router\WebRouter;
use Laminas\Di\Di;

class DiContainer
{
    protected $di;
    protected $instanceManager;

    public function __construct(Di $di)
    {
        $this->di = $di;
        $this->instanceManager = $di->instanceManager();
    }

    public function assemble()
    {
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if (strpos($method->getName(), 'assemble') == 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }

    protected function assembleRouters()
    {
        $this->instanceManager->setParameters(
            WebRouter::class,
            [
                'routes' => require APP_ROOT . '/etc/routes.php',
            ]
        );

        $this->instanceManager->setParameters(
            ApiRouter::class,
            [
                'apiRoutes' => require APP_ROOT . '/etc/ApiRoutes.php',
            ]
        );

        $this->instanceManager->setParameters(
            CliRouter::class,
            [
                'cliRoutes' => require APP_ROOT . '/etc/ConsoleRoutes.php',
            ]
        );
    }

    protected function assembleAbstract()
    {

    }
}
