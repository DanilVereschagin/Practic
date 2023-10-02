<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\PlayerBlock;
use App\Controller\Web\AbstractWebController;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\PlayerResource;
use App\Model\Session;

class CompanyController extends AbstractApiController
{
    public function execute()
    {
        $id = $this->getIdParam();

        $resource = new CompanyResource();
        $company = $resource->getById($id);

        header('Content-Type: application/json');
        echo json_encode($company);
    }
}
