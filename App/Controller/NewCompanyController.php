<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;

class NewCompanyController extends AbstractController
{
    public function execute()
    {
        (new NewCompanyBlock())->render();
    }
}
