<?php

namespace App\Block;

use App\Model\Session;

class AbstractAdminBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/admin-layout.phtml';
    }

    public function getCsrfToken()
    {
        return Session::getCsrfToken();
    }

    public function protectFromXss($data): string
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
