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

    public function __construct(
        Di $di,
        ResourceFactory $resourceFactory,
        ServiceFactory $serviceFactory,
        Session $session
    ) {
        parent::__construct($di, $session);
        $this->serviceFactory = $serviceFactory;
        $this->resourceFactory = $resourceFactory;
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
            $this->session->setClientId($player->getId());
            $this->session->setIsAdmin($player->getIsAdmin());
            $this->session->setCsrfToken();
            $this->redirectTo('/main');
        } else {
            $this->redirectTo('/login');
        }
    }
}
