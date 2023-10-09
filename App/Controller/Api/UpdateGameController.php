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

        $this->cacheMiddleware->updateGamesCache();

        $game = $resource->getById($post['id']);

        $this->responseSuccessJson($game);
    }
}
