<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Comment;
use App\Model\Game;
use App\Model\Resource\CommentResource;
use App\Model\Resource\GameResource;

class GameBlock extends AbstractBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    /**
     * @return Game
     */
    public function getGameInfo(): Game
    {
        $gameResource = new GameResource();
        return $gameResource->getById($this->id);
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
        return $commentResource->getParentComments($this->id);
    }

    /**
     * @return Comment[]
     */
    public function getChildComments(): array
    {
        $commentResource = new CommentResource();
        return $commentResource->getChildComments($this->id);
    }
}
