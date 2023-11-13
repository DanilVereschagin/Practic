<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class AdminPlayersBlock extends AbstractAdminBlock
{
    protected $playerResource;

    public function __construct(PlayerResource $playerResource, Session $session)
    {
        parent::__construct($session);
        $this->playerResource = $playerResource;
    }

    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/admin-players.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllPlayer(): array
    {
        return $this->playerResource->getAllPlayers();
    }
}
