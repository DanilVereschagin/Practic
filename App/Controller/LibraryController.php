<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\LibraryBlock;

class LibraryController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();

        if ($id == 0) {
            $id = ID;
        }

        $block = new LibraryBlock($id);
        $block->render();
    }
}
