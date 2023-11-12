<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use App\Model\Session;
use Laminas\Di\Di;

class AddCompanyController extends AbstractApiController
{
    protected $factory;
    public function __construct(Di $di, ResourceFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
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
