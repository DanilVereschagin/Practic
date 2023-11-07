<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class DeleteGameController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = new GameResource();
        $resource->delete($id);

        $gameRepository = new GameRepository();
        $gameRepository->deleteCache($this->getUri());

        header('Content-Type: application/json');
    }
}
