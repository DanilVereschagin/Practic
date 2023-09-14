<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewCompanyBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/newcompany.phtml';
    }
}
