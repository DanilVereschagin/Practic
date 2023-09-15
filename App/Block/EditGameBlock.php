<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;

class EditGameBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-game.phtml';
    }

    /**
     * @return Game
     */
    public function getGameInfo(): Game
    {
        $gameResource = new GameResource();
        return $gameResource->getById($this->id);
    }
}
