<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use Laminas\Di\Di;

class AddCompanyController extends AbstractWebController
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
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['name', 'type', 'address']);
        $resource = $this->factory->create('company', ['di' => $this->di]);
        $resource->add($post);

        $this->redirectTo('/companies');
    }
}
