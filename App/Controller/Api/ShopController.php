<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;

class ShopController extends AbstractApiController
{
    public function execute()
    {
        $gameRepository = new GameRepository();
        $games = $gameRepository->initCache($this->getUri());

        $this->responseSuccessJson($games);
    }
}
