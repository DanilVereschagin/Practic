<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;

class AdminGamesBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-games.phtml';
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        $gameResource = new GameResource();
        return $gameResource->getAll();
    }
}
