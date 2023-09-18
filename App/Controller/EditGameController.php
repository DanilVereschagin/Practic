<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditGameBlock;

class EditGameController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditGameBlock($id);
        $block->render();
    }
}
