<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditCompanyBlock;
use App\Model\Resource\CompanyResource;

class DeleteCompanyController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new CompanyResource();
        $resource->delete($id);

        $this->redirectTo('/companies');
    }
}
