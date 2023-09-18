<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\MainBlock;

class MainController extends AbstractController
{
    public function execute()
    {
        $id = $this->getQueryParam('id');

        $block = new MainBlock();
        $block->render();
    }
}
