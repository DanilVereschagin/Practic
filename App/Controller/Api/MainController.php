<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\PlayerResource;

class MainController extends AbstractApiController
{
    public function execute()
    {
        $playerResource = new PlayerResource();
        $players = $playerResource->getAllPlayers();

        $this->cacheRepository->set($this->getUri(), json_encode($players));

        $this->responseSuccessJson($players);
    }
}
