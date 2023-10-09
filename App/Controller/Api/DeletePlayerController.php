<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Resource\PlayerResource;

class DeletePlayerController extends AbstractApiController
{
    public function execute()
    {
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = new PlayerResource();
        $resource->delete($id);

        $this->cacheMiddleware->getPlayersCache();

        header('Content-Type: application/json');
    }
}
