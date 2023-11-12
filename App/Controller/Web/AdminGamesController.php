<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminGamesBlock;
use App\Factory\BlockFactory;
use Laminas\Di\Di;

class AdminGamesController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
    }

    public function execute()
    {
        $block = $this->factory->create('adminGames', ['di' => $this->di]);
        $block->render();
    }
}
