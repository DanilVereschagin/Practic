<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewGameBlock;
use App\Model\Resource\GameResource;

class AddGameController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['name', 'company', 'genre', 'year_of_release', 'score', 'description']);
            $resource = new GameResource();
            $resource->add($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo('/admin-games');
    }
}
