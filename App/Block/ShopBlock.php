<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;

class ShopBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/shop.phtml';
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        $gameResource = new GameResource();
        $games = $gameResource->getAll();
        return $games;
    }
}
