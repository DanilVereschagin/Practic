<?php

declare(strict_types=1);

namespace App\Controller\Api;

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

        $this->cacheMiddleware->deleteGamesCache();

        header('Content-Type: application/json');
    }
}
