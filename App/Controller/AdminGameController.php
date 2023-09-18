<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\AdminGameBlock;

class AdminGameController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        $block = new AdminGameBlock($id);
        $block->render();
    }
}
