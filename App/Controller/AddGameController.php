<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewGameBlock;

class AddGameController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post =  [
                'name'            => $postParams['name'],
                'company'         => $postParams['company'],
                'genre'           => $postParams['genre'],
                'year_of_release' => $postParams['year_of_release'],
                'score'           => $postParams['score']
            ];

            (new NewGameBlock())->addGame($post);
        }
        $this->redirectTo('/shop');
    }
}
