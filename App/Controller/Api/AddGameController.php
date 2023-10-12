<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;
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

        $gameRepository = new GameRepository();
        $gameRepository->initCache($this->getUri());

        $game = $resource->getByName($post['name']);

        $this->responseSuccessJson($game, 201);
    }
}
