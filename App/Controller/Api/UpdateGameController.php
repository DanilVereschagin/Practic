<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class UpdateGameController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new GameResource();
        $resource->update($post);

        $gameRepository = new GameRepository();
        $gameRepository->initCache($this->getUri());

        $game = $resource->getById($post['id']);

        $this->responseSuccessJson($game);
    }
}
