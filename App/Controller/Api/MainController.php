<?php

declare(strict_types=1);

namespace App\Controller\Api;

class MainController extends AbstractApiController
{
    public function execute()
    {
        $players = $this->cacheMiddleware->getPlayersCache();

        $this->responseSuccessJson($players);
    }
}
