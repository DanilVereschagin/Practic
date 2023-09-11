<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\CompaniesBlock;

class CompaniesController extends AbstractController
{
    public function execute()
    {
        (new CompaniesBlock())->render();
    }
}
