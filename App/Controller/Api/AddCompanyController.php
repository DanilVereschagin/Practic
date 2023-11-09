<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class AddCompanyController extends AbstractApiController
{
    protected $factory;
    public function __construct(Di $di, ResourceFactory $factory)
    {
        parent::__construct($di);
        $this->di = $di;
        $this->factory = $factory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = $this->factory->create('company', ['di' => $this->di]);
        $resource->add($post);

        $company = $resource->getByName($post['name']);

        $this->responseSuccessJson($company, 201);
    }
}
