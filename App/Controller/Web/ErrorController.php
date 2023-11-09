<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\ErrorBlock;
use App\Factory\BlockFactory;
use App\Model\Session;
use Laminas\Di\Di;

class ErrorController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
        $this->di = $di;
    }

    public function execute()
    {
        $message = Session::getMessage();
        $block = $this->factory->create('error', ['message' => $message, 'di' => $this->di]);
        Session::deleteVariable('message');
        $block->render();
    }
}
