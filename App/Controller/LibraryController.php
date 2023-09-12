<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\LibraryBlock;

class LibraryController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');

        if ($id == 0) {
            $id = ID;
        }

        (new LibraryBlock($id))->render();
    }
}
