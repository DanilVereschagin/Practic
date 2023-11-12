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

    public function __construct(Di $di, BlockFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        $message = $this->session->getMessage();
        $block = $this->factory->create('error', ['message' => $message, 'di' => $this->di]);
        $this->session->deleteVariable('message');
        $block->render();
    }
}
