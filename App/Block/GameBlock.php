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
    protected $di;

    public function __construct(?int $id, Di $di)
    {
        $this->id = $id;
        $this->di = $di;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    public function getGameInfo(): Game
    {
        $gameResource = $this->di->get(GameResource::class, ['di' => $this->di]);
        return $gameResource->getComplexInfoById($this->id);
    }

    /**
     * @return Comment[]
     */
    public function getParentComments(): array
    {
        $commentResource = $this->di->get(CommentResource::class, ['di' => $this->di]);
        return $commentResource->getParentComments($this->id);
    }

    /**
     * @return Comment[]
     */
    public function getChildComments(): array
    {
        $commentResource = $this->di->get(CommentResource::class, ['di' => $this->di]);
        return $commentResource->getChildComments($this->id);
    }
}
