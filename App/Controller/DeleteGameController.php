<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\GameResource;

class DeleteGameController extends AbstractController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new GameResource();
        $resource->delete($id);

        $this->redirectTo("/admin-games");
    }
}
