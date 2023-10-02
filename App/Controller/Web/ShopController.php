<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\ShopBlock;

class ShopController extends AbstractWebController
{
    public function execute()
    {
        $block = new ShopBlock();
        $block->render();
    }
}
