<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class DeleteCompanyController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

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
