<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\MainBlock;

class MainController extends AbstractController
{
    public function execute()
    {
        $block = new MainBlock();
        $block->render();
    }
}
