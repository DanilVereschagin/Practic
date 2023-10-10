<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\GameResource;

class ShopController extends AbstractApiController
{
    public function execute()
    {
        $gameResource = new GameResource();
        $games = $gameResource->getAll();

        $this->cacheRepository->set($this->getUri(), json_encode($games));

        $this->responseSuccessJson($games);
    }
}
