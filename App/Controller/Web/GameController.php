<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\GameBlock;

class GameController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new GameBlock($id);
        $block->render();
    }
}
