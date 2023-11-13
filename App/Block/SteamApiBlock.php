<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Session;
use Laminas\Di\Di;

class SteamApiBlock extends AbstractBlock
{
    protected array $games;

    public function __construct(array $games, Session $session)
    {
        parent::__construct($session);
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
