<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;
use App\Model\Resource\CompanyResource;

class UpdateCompanyController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post = [
                'id'      => $postParams['id'],
                'name'    => $postParams['name'],
                'type'    => $postParams['type'],
                'address' => $postParams['address'],
            ];

            (new CompanyResource())->update($post);
        }

        $this->redirectTo("Location: /companies");
    }
}
