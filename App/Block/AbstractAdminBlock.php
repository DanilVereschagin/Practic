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
        Session::start();
        return Session::getCsrfToken();
    }
}
