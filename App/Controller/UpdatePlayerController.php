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
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(["id", "name", "surname", "username", "mail", "fake_hour", "is_admin"]);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post["mail"]);

        if ($player->getId() != $post["id"] && $player->getMail() == $post["mail"]) {
            Session::setMessage("Данный email уже занят");
            $this->redirectTo("/error");
        }

        if (!Session::IsAdmin() == 1) {
            $post["is_admin"] = Session::IsAdmin();
            $resource->update($post);
            $this->redirectTo("/player");
        }
        $resource->update($post);

        $this->redirectTo("/admin-players");
    }
}
