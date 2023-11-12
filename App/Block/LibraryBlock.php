<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Player;
use App\Model\Resource\GameResource;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class LibraryBlock extends AbstractBlock
{
    protected int $id;
    protected $playerResource;
    protected $gameResource;

    public function __construct(
        int $id,
        Di $di,
        PlayerResource $playerResource,
        GameResource $gameResource,
        Session $session
    ) {
        parent::__construct($di, $session);
        $this->id = $id;
        $this->playerResource = $playerResource;
        $this->gameResource = $gameResource;
    }

    public function renderTemplate()
    {
        $player = $this->getPlayerInfo();
        require_once APP_ROOT . '/view/template/library.phtml';
    }

    public function getPlayerInfo(): Player
    {
        return $this->playerResource->getById($this->id);
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        return $this->gameResource->getLibraryGames($this->id);
    }
}
