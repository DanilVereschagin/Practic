<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\EditGameBlock;

class EditGameController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditGameBlock($id);
        $block->render();
    }
}
