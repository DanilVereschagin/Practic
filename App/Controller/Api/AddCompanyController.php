<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class AddCompanyController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new CompanyResource();
        $resource->add($post);

        $company = $resource->getByName($post['name']);

        $this->responseSuccessJson($company, 201);
    }
}
