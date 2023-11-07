<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\ErrorBlock;
use App\Model\Session;
use Laminas\Di\Di;

class ErrorController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $message = Session::getMessage();
        $block = new ErrorBlock($message);
        Session::deleteVariable('message');
        $block->render();
    }
}
