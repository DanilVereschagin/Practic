<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\GameResource;

class AddGameController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = json_decode(file_get_contents('php://input'), true);
        $resource = new GameResource();
        $resource->add($post);

        $game = $resource->getByName($post['name']);

        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(($game));
    }
}
