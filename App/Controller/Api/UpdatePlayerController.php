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

        $post = $this->getRowBody();
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && !is_null($player->getMail())) {
            http_response_code(400);
            return;
        }

        $resource->update($post);

        $players = $resource->getAllPlayers();
        $this->cacheRepository->update($this->getUri(), $players);

        $player = $resource->getByMail($post['mail']);

        $this->responseSuccessJson($player);
    }
}
