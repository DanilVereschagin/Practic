<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\NewGameBlock;

class NewGameController extends AbstractWebController
{
    public function execute()
    {
        $block = new NewGameBlock();
        $block->render();
    }
}
