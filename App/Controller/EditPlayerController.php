<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;
use App\Block\AdminEditPlayerBlock;
use App\Model\Session;

class EditPlayerController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $clientId = Session::getClientId();

        if ($id == $clientId) {
            $block = new EditPlayerBlock($id);
            $block->render();
        } elseif (Session::getIsAdmin() == 1) {
            $block = new AdminEditPlayerBlock($id);
            $block->render();
        } else {
            $this->redirectTo("/player?id=" . $id);
        }
    }
}
