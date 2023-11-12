<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Comment;
use App\Model\Game;
use App\Model\Resource\CommentResource;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class GameBlock extends AbstractBlock
{
    protected ?int $id;
    protected $gameResource;
    protected $commentResource;

    public function __construct(?int $id, Di $di, GameResource $gameResource, CommentResource $commentResource)
    {
        parent::__construct($di);
        $this->id = $id;
        $this->gameResource = $gameResource;
        $this->commentResource = $commentResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    public function getGameInfo(): Game
    {
        return $this->gameResource->getComplexInfoById($this->id);
    }

    /**
     * @return Comment[]
     */
    public function getParentComments(): array
    {
        return $this->commentResource->getParentComments($this->id);
    }

    /**
     * @return Comment[]
     */
    public function getChildComments(): array
    {
        return $this->commentResource->getChildComments($this->id);
    }
}
