<?php

namespace App\Block;

class AbstractAdminBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/admin-layout.phtml';
    }
}
