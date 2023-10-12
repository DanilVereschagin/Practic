<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\PlayerRepository;

class MainController extends AbstractApiController
{
    public function execute()
    {
        $playerRepository = new PlayerRepository();
        $players = $playerRepository->initCache($this->getUri());

        $this->responseSuccessJson(json_encode($players));
    }
}
