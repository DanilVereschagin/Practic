<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\PlayerBlock;
use App\Controller\Web\AbstractWebController;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class CompanyController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();

        $resource = new CompanyResource();
        $company = $resource->getById($id);

        $this->responseSuccessJson($company);
    }
}
