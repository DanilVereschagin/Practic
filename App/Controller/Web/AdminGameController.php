<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminGameBlock;
use App\Factory\BlockFactory;
use App\Model\Session;
use Laminas\Di\Di;

class AdminGameController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $block = $this->factory->create('adminGame', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
