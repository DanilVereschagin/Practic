<?php

namespace App\Block;

class AbstractGuestBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/guest-layout.phtml';
    }
}
