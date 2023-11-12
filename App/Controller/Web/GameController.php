<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\GameBlock;
use App\Factory\BlockFactory;
use Laminas\Di\Di;

class GameController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $block = $this->factory->create('game', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
