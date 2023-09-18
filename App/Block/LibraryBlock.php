<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Player;
use App\Model\Resource\GameResource;
use App\Model\Resource\PlayerResource;

class LibraryBlock extends AbstractBlock
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        $player = $this->getPlayerInfo();
        require_once APP_ROOT . '/view/template/library.phtml';
    }

    /**
     * @return Player
     */
    public function getPlayerInfo(): Player
    {
        $playerResource = new PlayerResource();
        return $playerResource->getById($this->id, 'player');
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        $gameResource = new GameResource();
        return $gameResource->getLibraryGames($this->id);
    }
}
