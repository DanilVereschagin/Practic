<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class GameBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/layout/player-layout.phtml';
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    public function getGameInfo(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select game.name, company.name as Company, genre.name_of_genre, game.year_of_release, game.score
                from game
                left join company on company.id = game.company
                left join genre on genre.genre_id = game.genre
                where game.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(array('ID' => ID));
        $gameInfo = $query->fetchAll();

        return $gameInfo;
    }

    public function getGameDescription(): string
    {
        return 'Игра крутая, ну ваще';
    }

    public function getComments(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.username, comment.id, comment.text_of_comment, comment.date_of_writing
                from player
                left join comment on comment.username = player.id
                where comment.game = :ID and comment.id in (select discussion.parent_comment from discussion);';
        $query = $connection->prepare($sql);
        $query->execute(array('ID' => ID));
        $comments = $query->fetchAll();

        return $comments;
    }

    public function getChildComments(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select 
                        player.username,
                        comment.id,
                        discussion.parent_comment, 
                        comment.text_of_comment, 
                        comment.date_of_writing
                from player
                left join comment on comment.username = player.id
                left join discussion on discussion.child_comment = comment.id
                where comment.game = :ID and comment.id in (select discussion.child_comment from discussion);';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => ID]);
        $childComments = $query->fetchAll();
        return $childComments;
    }
}
