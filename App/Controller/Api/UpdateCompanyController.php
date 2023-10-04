<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\CompanyResource;

class UpdateCompanyController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new CompanyResource();
        $resource->update($post);

        $company = $resource->getById($post['id']);

        $this->responseSuccessJson($company);
    }
}
