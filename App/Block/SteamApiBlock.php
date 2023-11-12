<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use Laminas\Di\Di;

class SteamApiBlock extends AbstractBlock
{
    protected array $games;

    public function __construct(Di $di, array $games)
    {
        parent::__construct($di);
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
