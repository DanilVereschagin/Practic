<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class AdminGamesBlock extends AbstractAdminBlock
{
    public function __construct(Di $di)
    {
        $this->di = $di;
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
        $gameResource = $this->di->get(GameResource::class, ['di' => $this->di]);
        return $gameResource->getAll();
    }
}
