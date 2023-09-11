<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditGameBlock;

class UpdateGameController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post =  [
                'name'            => $postParams['name'],
                'company'         => $postParams['company'],
                'genre'           => $postParams['genre'],
                'year_of_release' => $postParams['year_of_release'],
                'score'           => $postParams['score']
            ];

            (new EditGameBlock($id))->updateGame($post);
        }

        $this->redirectTo("Location: /admin-games");
    }
}
