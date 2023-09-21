<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\LoginBlock;

class LoginController extends AbstractController
{
    public function execute()
    {
        $block = new LoginBlock();
        $block->render();
    }
}
