<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\PlayerBlock;
use App\Model\Session;

class PlayerController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();

        if ($id == 0) {
            $id = Session::getClientId();
        }

        $block = new PlayerBlock($id);
        $block->render();
    }
}
