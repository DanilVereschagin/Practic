<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\PlayerRepository;
use Laminas\Di\Di;

class MainController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $playerRepository = new PlayerRepository();
        $players = $playerRepository->initCache($this->getUri());

        $this->responseSuccessJson(json_encode($players));
    }
}
