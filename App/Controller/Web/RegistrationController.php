<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\RegistrationBlock;

class RegistrationController extends AbstractWebController
{
    public function execute()
    {
        $block = new RegistrationBlock();
        $block->render();
    }
}
