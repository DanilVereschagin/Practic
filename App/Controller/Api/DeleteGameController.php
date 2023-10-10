<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\GameRepository;
use App\Model\Resource\GameResource;

class DeleteGameController extends AbstractApiController
{
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
