<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;
use Laminas\Di\Di;

class ShopController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $gameRepository = new GameRepository();
        $games = $gameRepository->initCache($this->getUri());

        $this->responseSuccessJson(json_encode($games));
    }
}
