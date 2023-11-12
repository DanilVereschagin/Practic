<?php

namespace App\Block;

use App\Model\Session;
use Laminas\Di\Di;

class AbstractAdminBlock
{
    protected Di $di;
    protected $session;

    public function __construct(Di $di, Session $session)
    {
        $this->di = $di;
        $this->session = $session;
    }

    public function render()
    {
        require_once APP_ROOT . '/view/layout/admin-layout.phtml';
    }

    public function getCsrfToken()
    {
        return $this->session->getCsrfToken();
    }

    public function protectFromXss($data): string
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
