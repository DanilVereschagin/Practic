<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;
use App\Model\Session;
use Laminas\Di\Di;

class AdminGamesBlock extends AbstractAdminBlock
{
    protected $gameResource;

    public function __construct(GameResource $gameResource, Session $session)
    {
        parent::__construct($session);
        $this->gameResource = $gameResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-games.phtml';
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        return $this->gameResource->getAll();
    }
}
