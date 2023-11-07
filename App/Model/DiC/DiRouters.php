<?php

declare(strict_types=1);

namespace App\Model\DiC;

use App\Router\ApiRouter;
use App\Router\CliRouter;
use App\Router\WebRouter;
use Laminas\Di\Di;

class DiRouters
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
        $this->instanceManager->setParameters(
            WebRouter::class,
            [
                'routes' => require APP_ROOT . '/etc/routes.php',
                'di'     => $this->di,
            ]
        );

        $this->instanceManager->setParameters(
            ApiRouter::class,
            [
                'apiRoutes' => require APP_ROOT . '/etc/ApiRoutes.php',
                'di'     => $this->di,
            ]
        );

        $this->instanceManager->setParameters(
            CliRouter::class,
            [
                'cliRoutes' => require APP_ROOT . '/etc/ConsoleRoutes.php',
                'di'     => $this->di,
            ]
        );
    }
}
