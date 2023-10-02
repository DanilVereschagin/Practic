<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\LoginBlock;

class LoginController extends AbstractWebController
{
    public function execute()
    {
        $block = new LoginBlock();
        $block->render();
    }
}
