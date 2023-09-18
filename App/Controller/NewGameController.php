<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewGameBlock;

class NewGameController extends AbstractController
{
    public function execute()
    {
        $block = new NewGameBlock();
        $block->render();
    }
}
