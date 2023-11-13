<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;
use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class AdminEditPlayerBlock extends AbstractAdminBlock
{
    protected ?int $id;
    protected $playerResource;

    public function __construct(?int $id, PlayerResource $playerResource, Session $session)
    {
        parent::__construct($session);
        $this->id = $id;
        $this->playerResource = $playerResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-edit-player.phtml';
    }

    public function getPlayerInfo(): Player
    {
        return $this->playerResource->getById($this->id);
    }
}
