<?php

declare(strict_types=1);

namespace App\Controller\Api;

class ShopController extends AbstractApiController
{
    public function execute()
    {
        $players = $this->cacheMiddleware->getGamesCache();

        $this->responseSuccessJson($players);
    }
}
