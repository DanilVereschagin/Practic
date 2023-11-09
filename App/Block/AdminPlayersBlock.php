<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class AdminPlayersBlock extends AbstractAdminBlock
{
    public function __construct(Di $di)
    {
        $this->di = $di;
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
        $playerResource = $this->di->get(PlayerResource::class, ['di' => $this->di]);
        return $playerResource->getAllPlayers();
    }
}
