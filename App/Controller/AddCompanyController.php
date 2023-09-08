<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;

class AddCompanyController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post = [
                'name'    => $postParams['name'],
                'type'    => $postParams['type'],
                'address' => $postParams['address'],
            ];

            (new NewCompanyBlock())->addCompany($post);
        }
        $this->redirectTo('/main');
    }
}
