<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\ErrorBlock;

class ErrorController extends AbstractController
{
    public function execute()
    {
        $message = $this->getQueryParam("message");
        $block = new ErrorBlock($message);
        $block->render();
    }
}
