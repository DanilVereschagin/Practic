<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\PlayerRepository;
use App\Model\Resource\PlayerResource;

class AddPlayerController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if (!is_null($player->getMail())) {
            http_response_code(400);
            return;
        }

        $playerRepository = new PlayerRepository();
        $post = $playerRepository->setDefaultValues($post);
        $resource->add($post);

        $playerRepository->setCache($this->getUri());

        $player = $resource->getByMail($post['mail']);

        $this->responseSuccessJson($player, 201);
    }
}
