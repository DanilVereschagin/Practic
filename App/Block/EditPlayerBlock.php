<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;
use App\Model\Player;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class EditPlayerBlock extends AbstractBlock
{
    protected ?int $id;
    protected $playerResource;

    public function __construct(?int $id, Di $di, PlayerResource $playerResource)
    {
        parent::__construct($di);
        $this->id = $id;
        $this->playerResource = $playerResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-player.phtml';
    }

    public function getPlayerInfo(): Player
    {
        return $this->playerResource->getById($this->id);
    }
}
