<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\CompanyResource;

class UpdateCompanyController extends AbstractWebController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['id', 'name', 'type', 'address']);
        $resource = new CompanyResource();
        $resource->update($post);

        $this->redirectTo('/companies');
    }
}
