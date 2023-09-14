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
            $postParams = $this->getPostParams();
            $post =  [
                'id'              => $postParams['id'],
                'name'            => $postParams['name'],
                'company'         => $postParams['company'],
                'genre'           => $postParams['genre'],
                'year_of_release' => $postParams['year_of_release'],
                'score'           => $postParams['score']
            ];

            (new GameResource())->update($post);
        }

        $this->redirectTo("Location: /admin-games");
    }
}
