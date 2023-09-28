<?php

namespace App\Block;

use App\Model\Session;

class AbstractBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/player-layout.phtml';
    }

    public function getCsrfToken()
    {
        return Session::getCsrfToken();
    }
}
