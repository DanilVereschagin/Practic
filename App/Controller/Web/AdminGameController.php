<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminGameBlock;
use App\Factory\BlockFactory;
use Laminas\Di\Di;

class AdminGameController extends AbstractWebController
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
        $block = $this->factory->create('adminGame', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
