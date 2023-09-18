<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\GameResource;

class UpdateGameController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $post = $this->getPostValues(['id', 'name', 'company', 'genre', 'year_of_release', 'score', 'description']);
            $resource = new GameResource();
            $resource->update($post);
        } else {
            http_response_code(405);
        }

        $this->redirectTo("/admin-games");
    }
}
