<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\PlayerResource;
use App\Model\Service\PasswordService;
use App\Model\Session;

class SignInController extends AbstractWebController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['mail', 'password']);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);
        $password = new PasswordService();

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
