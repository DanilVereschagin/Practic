<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Password;
use App\Model\Resource\PlayerResource;
use App\Model\Session;

class SignInController extends AbstractController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['mail', 'password']);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);
        $password = new Password();

        if ($password->verifyPassword($post['password'], $player->getPassword())) {
            Session::setClientId($player->getId());
            Session::setIsAdmin($player->getIsAdmin());
            $this->redirectTo('/main');
        } else {
            $this->redirectTo('/login');
        }
    }
}
