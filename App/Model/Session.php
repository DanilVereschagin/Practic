<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Service\SecurityService;

class Session
{
    protected $securityService;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;

        if (!$this->securityService) {
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
        $_SESSION['csrf_token'] = $this->securityService->generateCsrf();
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
