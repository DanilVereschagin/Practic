<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\GameResource;

class UpdateGameController extends AbstractWebController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['id', 'name', 'company', 'genre', 'year_of_release', 'score', 'description']);
        $resource = new GameResource();
        $resource->update($post);

        $this->redirectTo('/admin-games');
    }
}