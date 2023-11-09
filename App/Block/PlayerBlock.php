<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class PlayerBlock extends AbstractBlock
{
    protected int $id;
    public function __construct(int $id, Di $di)
    {
        $this->di = $di;
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/player.phtml';
    }

    public function getPlayerInfo(): Player
    {
        $playerResource = $this->di->get(PlayerResource::class, ['di' => $this->di]);
        return $playerResource->getById($this->id);
    }
}
