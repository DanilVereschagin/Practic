<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminGameBlock;

class AdminGameController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new AdminGameBlock($id);
        $block->render();
    }
}
