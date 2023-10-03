<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\CompanyResource;

class DeleteCompanyController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = new CompanyResource();
        $resource->delete($id);

        header('Content-Type: application/json');
    }
}
