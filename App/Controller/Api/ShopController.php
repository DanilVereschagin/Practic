<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;

class ShopController extends AbstractApiController
{
    public function execute()
    {
        $gameRepository = new GameRepository();
        $gameRepository->setCache($this->getUri());

        $this->responseSuccessJson($gameRepository->getAll());
    }
}
