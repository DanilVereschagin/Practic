<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Factory\ServiceFactory;
use Laminas\Di\Di;

class AddPlayerController extends AbstractWebController
{
    protected $resourceFactory;
    protected $serviceFactory;
    public function __construct(Di $di, ResourceFactory $resourceFactory, ServiceFactory $serviceFactory)
    {
        parent::__construct($di);
        $this->resourceFactory = $resourceFactory;
        $this->serviceFactory = $serviceFactory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['name', 'surname', 'username', 'mail', 'password']);
        $post['date_of_registration'] = date('Y-m-d h:i:s');
        $post['is_admin'] = 0;
        $post['fake_hour'] = 0;
        $password = $this->serviceFactory->create('password', ['di' => $this->di]);
        $post['password'] = $password->hashPassword($post['password']);
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $resource->add($post);

        $this->redirectTo('/login');
    }
}
