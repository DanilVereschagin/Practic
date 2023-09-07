<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;

class AddCompanyController extends AbstractController
{
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new NewCompanyBlock())->addCompany();
        }
        header('Location: /main', true, 302);
    }
}
