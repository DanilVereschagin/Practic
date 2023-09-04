<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\RenderBlock;

class IndexController extends AbstractController
{
    public function execute()
    {
        (new RenderBlock())->render();
    }
}
