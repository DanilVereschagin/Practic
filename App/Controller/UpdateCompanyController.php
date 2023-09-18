<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;
use App\Model\Resource\CompanyResource;

class UpdateCompanyController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['id', 'name', 'type', 'address']);
            $resource = new CompanyResource();
            $resource->update($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo("/companies");
    }
}
