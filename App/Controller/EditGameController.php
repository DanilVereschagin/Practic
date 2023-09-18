<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditGameBlock;

class EditGameController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        $block = new EditGameBlock($id);
        $block->render();
    }
}
