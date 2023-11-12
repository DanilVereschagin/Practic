<?php

declare(strict_types=1);

namespace App\Model\DiC;

use App\Model\Service\LoggerService;
use Laminas\Di\Di;
use Monolog\Logger;

class DiServices
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
            LoggerService::class,
            [
                'logger' => $this->di->get(Logger::class, ['name' => 'name']),
                'di'     => $this->di,
            ]
        );
    }
}
