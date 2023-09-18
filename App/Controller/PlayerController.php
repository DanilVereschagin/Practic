<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\PlayerBlock;

class PlayerController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');

        if ($id == 0) {
            $id = ID;
        }

        $block = new PlayerBlock($id);
        $block->render();
    }
}
