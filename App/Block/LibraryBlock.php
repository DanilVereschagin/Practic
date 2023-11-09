<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Player;
use App\Model\Resource\GameResource;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class LibraryBlock extends AbstractBlock
{
    protected int $id;

    public function __construct(int $id, Di $di)
    {
        $this->di = $di;
        $this->id = $id;
    }

    public function renderTemplate()
    {
        $player = $this->getPlayerInfo();
        require_once APP_ROOT . '/view/template/library.phtml';
    }

    public function getPlayerInfo(): Player
    {
        $playerResource = $this->di->get(PlayerResource::class, ['di' => $this->di]);
        return $playerResource->getById($this->id);
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        $gameResource = $this->di->get(GameResource::class, ['di' => $this->di]);
        return $gameResource->getLibraryGames($this->id);
    }
}
