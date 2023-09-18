<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\GameResource;

class UpdateGameController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['id', 'name', 'company', 'genre', 'year_of_release', 'score', 'description']);
            $resource = new GameResource();
            $resource->update($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo("/admin-games");
    }
}
