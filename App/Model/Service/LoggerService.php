<?php

declare(strict_types=1);

namespace App\Model\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerService
{
    protected static $log;

    private function __construct()
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(APP_ROOT . '/var/log/warning.log', Logger::WARNING));
        $log->pushHandler(new StreamHandler(APP_ROOT . '/var/log/error.log', Logger::ERROR));
        self::$log = $log;
    }

    public static function getInstance()
    {
        if (self::$log === null) {
            new self();
        }

        return self::$log;
    }

    public static function warning(string $message)
    {
        self::$log->warning($message);
    }

    public static function error(string $message)
    {
        self::$log->error($message);
    }
}
