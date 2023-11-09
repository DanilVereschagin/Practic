<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class DeleteCompanyController extends AbstractApiController
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
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = $this->resourceFactory->create('company', ['di' => $this->di]);
        $resource->delete($id);

        header('Content-Type: application/json');
    }
}
