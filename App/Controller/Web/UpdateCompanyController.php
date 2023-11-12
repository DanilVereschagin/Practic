<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class UpdateCompanyController extends AbstractWebController
{
    protected $factory;
    public function __construct(Di $di, ResourceFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['id', 'name', 'type', 'address']);
        $resource = $this->factory->create('company', ['di' => $this->di]);
        $resource->update($post);

        $this->redirectTo('/companies');
    }
}
