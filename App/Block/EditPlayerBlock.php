<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;
use App\Model\Player;
use App\Model\Resource\PlayerResource;

class EditPlayerBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-player.phtml';
    }

    /**
     * @return Player
     */
    public function getPlayerInfo(): Player
    {
        $playerResource = new PlayerResource();
        $player = $playerResource->getById($this->id);
        return $player;
    }
}
