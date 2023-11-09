<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\BlockFactory;
use Laminas\Di\Di;

class EditGameController extends AbstractWebController
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
        $id = $this->getIdParam();
        $block = $this->factory->create('editGame', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
