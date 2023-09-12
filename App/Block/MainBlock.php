<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;

class MainBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/main.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllPlayer(): array
    {
        $playerResource = new PlayerResource();
        $players = $playerResource->getAll();
        return $players;
    }
}
