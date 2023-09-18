<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;

class EditCompanyController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        $block = new EditCompanyBlock($id);
        $block->render();
    }
}
