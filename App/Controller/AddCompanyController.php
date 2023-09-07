<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;

class AddCompanyController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = [
                'name'    => $_POST['name'],
                'type'    => $_POST['type'],
                'address' => $_POST['address'],
            ];

            (new NewCompanyBlock())->addCompany($post);
        }
        $this->redirectTo('/main');
    }
}
