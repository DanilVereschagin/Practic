<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class DeleteCompanyController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, ResourceFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = $this->factory->create('company', ['di' => $this->di]);
        $resource->delete($id);

        $this->redirectTo('/companies');
    }
}
