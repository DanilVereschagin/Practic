<?php

declare(strict_types=1);

namespace App\Model\Service;

use Laminas\Di\Di;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerService
{
    protected $log;

    public function __construct(Logger $logger)
    {
        $logger->pushHandler(new StreamHandler(APP_ROOT . '/var/log/warning.log', Logger::WARNING));
        $logger->pushHandler(new StreamHandler(APP_ROOT . '/var/log/error.log', Logger::ERROR));
        $this->log = $logger;
    }

    public function warning(string $message, array $context = [])
    {
        $this->log->warning($message, $context);
    }

    public function error(string $message, array $context = [])
    {
        $this->log->error($message, $context);
    }
}
