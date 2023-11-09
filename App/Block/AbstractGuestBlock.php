<?php

namespace App\Block;

use Laminas\Di\Di;

class AbstractGuestBlock
{
    protected Di $di;

    public function render()
    {
        require_once APP_ROOT . '/view/layout/guest-layout.phtml';
    }
}
