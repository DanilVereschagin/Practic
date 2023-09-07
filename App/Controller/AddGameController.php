<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\GameBlock;

class AddGameController extends AbstractController
{
    public function execute()
    {
        (new GameBlock())->addGameRender();
    }

    public function add()
    {
        (new GameBlock())->addGame();
    }
}
