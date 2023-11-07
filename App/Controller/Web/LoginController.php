<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\LoginBlock;
use Laminas\Di\Di;

class LoginController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $block = new LoginBlock();
        $block->render();
    }
}
