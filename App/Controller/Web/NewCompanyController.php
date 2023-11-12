<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\NewCompanyBlock;
use App\Factory\BlockFactory;
use App\Model\Session;
use Laminas\Di\Di;

class NewCompanyController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        $block = $this->factory->create('newCompany', ['di' => $this->di]);
        $block->render();
    }
}
