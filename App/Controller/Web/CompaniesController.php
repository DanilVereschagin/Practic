<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\CompaniesBlock;

class CompaniesController extends AbstractWebController
{
    public function execute()
    {
        $block = new CompaniesBlock();
        $block->render();
    }
}
