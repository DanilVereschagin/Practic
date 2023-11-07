<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class DeleteCompanyController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new CompanyResource();
        $resource->delete($id);

        $this->redirectTo('/companies');
    }
}
