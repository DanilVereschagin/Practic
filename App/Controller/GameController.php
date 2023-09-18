<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\GameBlock;

class GameController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new GameBlock($id);
        $block->render();
    }
}
