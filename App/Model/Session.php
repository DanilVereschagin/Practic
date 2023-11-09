<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Service\SecurityService;
use Laminas\Di\Di;

class Session
{
    protected static $_instance;
    protected static $di;

    private function __construct(Di $di = null)
    {
        self::$di = $di;
        session_save_path(APP_ROOT . '/var/sessions');
    }

    public static function getInstance(Di $di = null)
    {
        if (self::$_instance === null) {
            self::$_instance = new self($di);
        }

        return self::$_instance;
    }

    public static function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function deleteVariable(string $variable)
    {
        unset($_SESSION[$variable]);
    }

    public static function setClientId(int $id)
    {
        $_SESSION['client_id'] = $id;
    }

    public static function setIsAdmin(int $is)
    {
        $_SESSION['is_admin'] = $is;
    }

    public static function getClientId()
    {
        return $_SESSION['client_id'] ?? null;
    }

    public static function IsAdmin()
    {
        return $_SESSION['is_admin'];
    }

    public static function setMessage(string $message)
    {
        $_SESSION['message'] = $message;
    }

    public static function getMessage()
    {
        return $_SESSION['message'] ?? null;
    }

    public static function setCsrfToken()
    {
        $securityService = self::$di->get(SecurityService::class, ['di' => self::$di]);
        $_SESSION['csrf_token'] = $securityService->generateCsrf();
    }

    public static function getCsrfToken()
    {
        return $_SESSION['csrf_token'] ?? null;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
