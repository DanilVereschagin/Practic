<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;

class EditPlayerController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditPlayerBlock($id);
        $block->render();
    }
}
