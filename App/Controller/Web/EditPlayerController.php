<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminEditPlayerBlock;
use App\Block\EditPlayerBlock;
use App\Model\Session;

class EditPlayerController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $clientId = Session::getClientId();

        if ($id == $clientId) {
            $block = new EditPlayerBlock($id);
            $block->render();
        } elseif (Session::IsAdmin()) {
            $block = new AdminEditPlayerBlock($id);
            $block->render();
        } else {
            $this->redirectTo('/player?id=' . $id);
        }
    }
}
