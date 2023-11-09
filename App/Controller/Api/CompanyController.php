<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\PlayerBlock;
use App\Controller\Web\AbstractWebController;
use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class CompanyController extends AbstractApiController
{
    protected $resourceFactory;
    public function __construct(Di $di, ResourceFactory $resourceFactory)
    {
        parent::__construct($di);
        $this->di = $di;
        $this->resourceFactory = $resourceFactory;
    }

    public function execute()
    {
        $id = $this->getIdParam();

        $resource = $this->resourceFactory->create('company', ['di' => $this->di]);
        $company = $resource->getById($id);

        $this->responseSuccessJson($company);
    }
}
