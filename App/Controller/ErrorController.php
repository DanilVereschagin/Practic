<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\ErrorBlock;
use App\Model\Session;

class ErrorController extends AbstractController
{
    public function execute()
    {
        $message = Session::getMessage();
        $block = new ErrorBlock($message);
        Session::deleteVariable("message");
        $block->render();
    }
}
