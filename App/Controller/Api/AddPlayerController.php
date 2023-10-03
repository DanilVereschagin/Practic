<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Password;
use App\Model\Resource\PlayerResource;

class AddPlayerController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = json_decode(file_get_contents('php://input'), true);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && $player->getMail() == $post['mail']) {
            echo 'mail уже занят!';
            return;
        }

        $post['date_of_registration'] = date('Y-m-d h:i:s');
        $post['is_admin'] = 0;
        $post['fake_hour'] = 0;
        $password = new Password();
        $post['password'] = $password->hashPassword($post['password']);
        $resource->add($post);

        $player = $resource->getByMail($post['mail']);

        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(($player));
    }
}
