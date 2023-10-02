<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminGamesBlock;

class AdminGamesController extends AbstractWebController
{
    public function execute()
    {
        $block = new AdminGamesBlock();
        $block->render();
    }
}
