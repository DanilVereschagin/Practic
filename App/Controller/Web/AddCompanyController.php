<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\CompanyResource;
use Laminas\Di\Di;

class AddCompanyController extends AbstractWebController
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

        $post = $this->getPostValues(['name', 'type', 'address']);
        $resource = new CompanyResource();
        $resource->add($post);

        $this->redirectTo('/companies');
    }
}
