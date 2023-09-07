<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\NewGameBlock;

class AddGameController extends AbstractController
{
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new NewGameBlock())->addGame();
        }
        header('Location: /shop', true, 302);
    }
}
