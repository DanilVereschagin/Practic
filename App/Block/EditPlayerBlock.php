<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;
use App\Model\Player;
use App\Model\Resource\PlayerResource;

class EditPlayerBlock extends AbstractBlock
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

    public function getPlayerInfo(): Player
    {
        $playerResource = new PlayerResource();
        return $playerResource->getById($this->id);
    }
}
