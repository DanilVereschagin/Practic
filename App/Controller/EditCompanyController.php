<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;

class EditCompanyController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditCompanyBlock($id);
        $block->render();
    }
}
