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

        $post = json_decode(file_get_contents('php://input'), true);
        $resource = new CompanyResource();
        $resource->update($post);

        $company = $resource->getById($post['id']);

        header('Content-Type: application/json');
        echo json_encode(($company));
    }
}
