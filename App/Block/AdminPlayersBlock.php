<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;

class AdminPlayersBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/admin-players.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllPlayer(): array
    {
        $playerResource = new PlayerResource();
        return $playerResource->getAllPlayers();
    }
}
