<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminBlock;

class AdminController extends AbstractWebController
{
    public function execute()
    {
        $block = new AdminBlock();
        $block->render();
    }
}
