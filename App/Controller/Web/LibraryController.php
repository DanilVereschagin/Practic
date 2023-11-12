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

    public function __construct(Di $di, BlockFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        $id = $this->getIdParam();

        if ($id == 0) {
            $id = $this->session->getClientId();
        }

        $block = $this->factory->create('library', ['id' => $id, 'di' => $this->di]);
        $block->render();
    }
}
