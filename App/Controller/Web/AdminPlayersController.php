<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminPlayersBlock;

class AdminPlayersController extends AbstractWebController
{
    public function execute()
    {
        $block = new AdminPlayersBlock();
        $block->render();
    }
}
