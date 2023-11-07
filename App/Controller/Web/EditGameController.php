<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\EditGameBlock;
use Laminas\Di\Di;

class EditGameController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $block = new EditGameBlock($id);
        $block->render();
    }
}
