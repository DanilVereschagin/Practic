<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Comment;
use App\Model\Database;
use App\Model\Game;
use App\Model\Resource\CommentResource;
use App\Model\Resource\GameResource;

class AdminGameBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-game.phtml';
    }

    /**
     * @return Game
     */
    public function getGameInfo(): Game
    {
        $gameResource = new GameResource();
        $game = $gameResource->getById($this->id);
        return $game;
    }

    public function getGameDescription(): string
    {
        return 'Игра крутая, ну ваще';
    }

    /**
     * @return Comment[]
     */
    public function getParentComments(): array
    {
        $commentResource = new CommentResource();
        $comments = $commentResource->getParentComments($this->id);
        return $comments;
    }

    /**
     * @return Comment[]
     */
    public function getChildComments(): array
    {
        $commentResource = new CommentResource();
        $comments = $commentResource->getChildComments($this->id);
        return $comments;
    }
}
