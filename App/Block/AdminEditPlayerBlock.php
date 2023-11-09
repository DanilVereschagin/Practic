<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;
use App\Model\Player;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class AdminEditPlayerBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id, Di $di)
    {
        $this->di = $di;
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-edit-player.phtml';
    }

    public function getPlayerInfo(): Player
    {
        $playerResource = $this->di->get(PlayerResource::class, ['di' => $this->di]);
        return $playerResource->getById($this->id);
    }
}
