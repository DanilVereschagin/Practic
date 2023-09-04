<?php

declare(strict_types=1);

namespace App\Block;

class MainBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/main.phtml';
    }
}
