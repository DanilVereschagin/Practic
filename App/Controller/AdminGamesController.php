<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\AdminGamesBlock;

class AdminGamesController extends AbstractController
{
    public function execute()
    {
        (new AdminGamesBlock())->render();
    }
}