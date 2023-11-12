<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class EditGameBlock extends AbstractAdminBlock
{
    protected ?int $id;
    protected $gameResource;

    public function __construct(?int $id, Di $di)
    {
        parent::__construct($di);
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-game.phtml';
    }

    public function getGameInfo(): Game
    {
        return $this->gameResource->getComplexInfoById($this->id);
    }
}
