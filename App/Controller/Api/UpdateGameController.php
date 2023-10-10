<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\GameResource;

class UpdateGameController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new GameResource();
        $resource->update($post);

        $games = $resource->getAll();
        $this->cacheRepository->update($this->getUri(), $games);

        $game = $resource->getById($post['id']);

        $this->responseSuccessJson($game);
    }
}
