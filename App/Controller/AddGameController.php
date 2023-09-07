<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewGameBlock;

class AddGameController extends AbstractController
{
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post =  [
                'name'            => $_POST['name'],
                'company'         => $_POST['company'],
                'genre'           => $_POST['genre'],
                'year_of_release' => $_POST['year_of_release'],
                'score'           => $_POST['score']
            ];

            (new NewGameBlock())->addGame($post);
        }
        header('Location: /shop', true, 302);
    }
}
