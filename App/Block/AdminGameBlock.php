<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Comment;
use App\Model\Database;
use App\Model\Game;
use App\Model\Resource\CommentResource;
use App\Model\Resource\GameResource;
use App\Model\Session;
use Laminas\Di\Di;

class AdminGameBlock extends AbstractAdminBlock
{
    protected ?int $id;
    protected $gameResource;
    protected $commentResource;

    public function __construct(
        ?int $id,
        Di $di,
        GameResource $gameResource,
        CommentResource $commentResource,
        Session $session
    ) {
        parent::__construct($di, $session);
        $this->id = $id;
        $this->gameResource = $gameResource;
        $this->commentResource = $commentResource;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-game.phtml';
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
