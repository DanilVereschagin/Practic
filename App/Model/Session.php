<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Service\SecurityService;
use Laminas\Di\Di;

class Session
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;

        if (!$di) {
            session_save_path(APP_ROOT . '/var/sessions');
        }
    }

    public function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function destroy()
    {
        session_destroy();
    }

    public function deleteVariable(string $variable)
    {
        unset($_SESSION[$variable]);
    }

    public function setClientId(int $id)
    {
        $_SESSION['client_id'] = $id;
    }

    public function setIsAdmin(int $is)
    {
        $_SESSION['is_admin'] = $is;
    }

    public function getClientId()
    {
        return $_SESSION['client_id'] ?? null;
    }

    public function IsAdmin()
    {
        return $_SESSION['is_admin'];
    }

    public function setMessage(string $message)
    {
        $_SESSION['message'] = $message;
    }

    public function getMessage()
    {
        return $_SESSION['message'] ?? null;
    }

    public function setCsrfToken()
    {
        $securityService = $this->di->get(SecurityService::class, ['di' => $this->di]);
        $_SESSION['csrf_token'] = $securityService->generateCsrf();
    }

    public function getCsrfToken()
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
