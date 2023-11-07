<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\GameBlock;
use Laminas\Di\Di;

class GameController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $block = new GameBlock($id);
        $block->render();
    }
}
