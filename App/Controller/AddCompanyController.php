<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewCompanyBlock;
use App\Model\Resource\CompanyResource;

class AddCompanyController extends AbstractController
{
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
