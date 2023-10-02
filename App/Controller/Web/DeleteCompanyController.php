<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\CompanyResource;

class DeleteCompanyController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new CompanyResource();
        $resource->delete($id);

        $this->redirectTo('/companies');
    }
}
