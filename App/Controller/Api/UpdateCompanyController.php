<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class UpdateCompanyController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

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
