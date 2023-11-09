<?php

declare(strict_types=1);

namespace App\Model\DiC;

use App\Model\Database;
use App\Model\Environment;
use App\Model\Service\LoggerService;
use App\Model\Service\WebApiSevice\SendinBlueApiService;
use App\Model\Session;
use Laminas\Di\Di;

class DiInstance
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
        Database::getInstance();
        Environment::getInstance($this->di);
        SendinBlueApiService::getInstance();
        Session::getInstance($this->di);
        LoggerService::getInstance();
    }
}
