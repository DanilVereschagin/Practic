<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\LibraryBlock;
use App\Model\Session;

class LibraryController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();

        if ($id == 0) {
            $id = Session::getClientId();
        }

        $block = new LibraryBlock($id);
        $block->render();
    }
}
