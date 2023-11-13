<?php

namespace App\Block;

use Laminas\Di\Di;

class AbstractGuestBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/guest-layout.phtml';
    }
}
