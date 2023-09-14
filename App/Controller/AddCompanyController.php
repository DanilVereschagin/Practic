<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;
use App\Model\Resource\CompanyResource;

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

            (new CompanyResource())->add($post);
        }
        $this->redirectTo('Location: /companies');
    }
}
