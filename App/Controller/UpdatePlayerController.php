<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;
use App\Model\Resource\PlayerResource;
use App\Model\Session;

class UpdatePlayerController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['id', 'name', 'surname', 'username', 'mail', 'fake_hour', 'is_admin']);
            $resource = new PlayerResource();
            $player = $resource->getByMail($post['mail']);
            if ($player->getId() != $post['id'] && $player->getMail() == $post['mail']) {
                $this->redirectTo("/error?message=" . "Данный email уже занят");
            }
            if (!Session::getIsAdmin() == 1) {
                $post['is_admin'] = 0;
            }
            $resource->update($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo("/admin-players");
    }
}
