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

        $post = $this->getRowBody();
        $resource = new GameResource();
        $resource->add($post);

        $games = $resource->getAll();
        $this->cacheRepository->update($this->getUri(), $games);

        $game = $resource->getByName($post['name']);

        $this->responseSuccessJson($game, 201);
    }
}
