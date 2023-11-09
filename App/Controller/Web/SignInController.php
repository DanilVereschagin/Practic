<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Factory\ServiceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class SignInController extends AbstractWebController
{
    protected $resourceFactory;
    protected $serviceFactory;

    public function __construct(Di $di, ResourceFactory $resourceFactory, ServiceFactory $serviceFactory)
    {
        parent::__construct($di);
        $this->serviceFactory = $serviceFactory;
        $this->resourceFactory = $resourceFactory;
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['mail', 'password']);
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $player = $resource->getByMail($post['mail']);
        $password = $this->serviceFactory->create('password', ['di' => $this->di]);

        if ($password->verifyPassword($post['password'], $player->getPassword())) {
            Session::setClientId($player->getId());
            Session::setIsAdmin($player->getIsAdmin());
            Session::setCsrfToken();
            $this->redirectTo('/main');
        } else {
            $this->redirectTo('/login');
        }
    }
}
