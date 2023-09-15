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
            $post = $this->getPostValues(['id', 'name', 'company', 'genre', 'year_of_release', 'score']);
            (new GameResource())->update($post);
        }

        $this->redirectTo("/admin-games");
    }
}
