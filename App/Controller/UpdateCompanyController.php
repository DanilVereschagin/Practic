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
            $post = $this->getPostValues(['id', 'name', 'type', 'address']);
            $resource = new CompanyResource();
            $resource->update($post);
        } else {
            http_response_code(405);
        }

        $this->redirectTo("/companies");
    }
}
