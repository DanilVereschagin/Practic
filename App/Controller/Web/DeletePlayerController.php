<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\PlayerResource;

class DeletePlayerController extends AbstractWebController
{
    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new PlayerResource();
        $resource->delete($id);

        $this->redirectTo('/admin-players');
    }
}
