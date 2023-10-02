<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\EditCompanyBlock;

class EditCompanyController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditCompanyBlock($id);
        $block->render();
    }
}
