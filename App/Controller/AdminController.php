<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\AdminBlock;

class AdminController extends AbstractController
{
    public function execute()
    {
        $id = $this->getQueryParam('id');
        $block = new AdminBlock();
        $block->render();
    }
}
