<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\AdminGameBlock;

class AdminGameController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new AdminGameBlock($id);
        $block->render();
    }
}
