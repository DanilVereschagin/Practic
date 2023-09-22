<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\PlayerResource;
use App\Model\Session;

class SignInController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['mail', 'password']);
            $resource = new PlayerResource();
            $player = $resource->getByMail($post['mail']);

            if (password_verify($post['password'], $player->getPassword())) {
                Session::setClientId($player->getId());
                Session::setIsAdmin($player->getIsAdmin());
                $this->redirectTo("/main");
            } else {
                $this->redirectTo("/login");
            }
        } else {
            $this->sendNotAllowedMethodError();
        }
    }
}
