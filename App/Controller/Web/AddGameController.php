<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\GameResource;

class AddGameController extends AbstractWebController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['name', 'company', 'genre', 'year_of_release', 'score', 'description']);
        $resource = new GameResource();
        $resource->add($post);

        $this->redirectTo('/admin-games');
    }
}
