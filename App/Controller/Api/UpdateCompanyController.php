<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class UpdateCompanyController extends AbstractApiController
{
    protected $resourceFactory;

    public function __construct(Di $di, ResourceFactory $resourceFactory, Session $session)
    {
        parent::__construct($di, $session);
        $this->resourceFactory = $resourceFactory;
    }

    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = $this->resourceFactory->create('company', ['di' => $this->di]);
        $resource->update($post);

        $company = $resource->getById($post['id']);

        $this->responseSuccessJson($company);
    }
}
