<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\LibraryBlock;
use App\Factory\BlockFactory;
use App\Model\Session;
use Laminas\Di\Di;

class LibraryController extends AbstractWebController
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

        if ($id == 0) {
            $id = Session::getClientId();
        }

        $block = $this->factory->create('library', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
