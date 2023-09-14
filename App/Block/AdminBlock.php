<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;

class AdminBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/admin.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllAdmins(): array
    {
        $playerResource = new PlayerResource();
        $admins = $playerResource->getAllAdmins();
        return $admins;
    }
}
