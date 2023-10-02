<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Web\AbstractWebController;
use App\Model\Resource\PlayerResource;
use App\Model\Session;

class UpdatePlayerController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = json_decode(file_get_contents('php://input'), true);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && $player->getMail() == $post['mail']) {
            echo 'mail уже занят!';
            return;
        }

        $resource->update($post);
    }
}
