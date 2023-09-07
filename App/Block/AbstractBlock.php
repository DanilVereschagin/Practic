<?php

namespace App\Block;

class AbstractBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/player-layout.phtml';
    }
}
