<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\PlayerRepository;

class MainController extends AbstractApiController
{
    public function execute()
    {
        $playerRepository = new PlayerRepository();
        $playerRepository->setCache($this->getUri());

        $this->responseSuccessJson($playerRepository->getAll());
    }
}
