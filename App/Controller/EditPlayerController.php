<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;

class EditPlayerController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        (new EditPlayerBlock($id))->render();
    }
}
