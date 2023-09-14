<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewGameBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/newgame.phtml';
    }
}
