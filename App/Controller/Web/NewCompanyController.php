<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\NewCompanyBlock;

class NewCompanyController extends AbstractWebController
{
    public function execute()
    {
        $block = new NewCompanyBlock();
        $block->render();
    }
}
