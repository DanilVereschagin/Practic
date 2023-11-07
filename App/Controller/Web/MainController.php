<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\MainBlock;
use Laminas\Di\Di;

class MainController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $block = new MainBlock();
        $block->render();
    }
}
