<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;

class SteamApiBlock extends AbstractBlock
{
    protected array $games;

    public function __construct(array $games)
    {
        $this->games = $games;
    }
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/shop.phtml';
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        return $this->games;
    }
}
