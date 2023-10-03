<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\ErrorBlock;
use App\Model\Session;

class ErrorController extends AbstractWebController
{
    public function execute()
    {
        $message = Session::getMessage();
        $block = new ErrorBlock($message);
        Session::deleteVariable('message');
        $block->render();
    }
}