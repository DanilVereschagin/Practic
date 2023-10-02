<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\MainBlock;

class MainController extends AbstractWebController
{
    public function execute()
    {
        $block = new MainBlock();
        $block->render();
    }
}
