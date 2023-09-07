<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\CompanyBlock;
use App\Block\GameBlock;

class CompanyController extends AbstractController
{
    public function execute()
    {
        (new CompanyBlock())->addGameRender();
    }

    public function add()
    {
        (new CompanyBlock())->addGame();
    }
}
