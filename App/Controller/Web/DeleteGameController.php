<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\GameResource;

class DeleteGameController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new GameResource();
        $resource->delete($id);

        $this->redirectTo('/admin-games');
    }
}
