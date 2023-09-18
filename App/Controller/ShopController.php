<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\ShopBlock;

class ShopController extends AbstractController
{
    public function execute()
    {
        $block = new ShopBlock();
        $block->render();
    }
}
