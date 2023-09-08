<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\AdminPlayersBlock;

class AdminPlayersController extends AbstractController
{
    public function execute()
    {
        (new AdminPlayersBlock())->render();
    }
}
