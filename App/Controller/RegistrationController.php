<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\RegistrationBlock;

class RegistrationController extends AbstractController
{
    public function execute()
    {
        $block = new RegistrationBlock();
        $block->render();
    }
}
