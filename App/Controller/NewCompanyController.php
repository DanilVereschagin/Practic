<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;

class NewCompanyController extends AbstractController
{
    public function execute()
    {
        $block = new NewCompanyBlock();
        $block->render();
    }
}
