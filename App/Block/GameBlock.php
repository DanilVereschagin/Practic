<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class GameBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    public function addGameRender()
    {
        require_once APP_ROOT . '/view/template/newgame.phtml';
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
        $query->execute(array('ID' => ID));
        $childComments = $query->fetchAll();
        return $childComments;
    }

    public function addGame()
    {

            $db = new Database();
            $connection = $db->getConnection();
            $sql = "insert into game
                    set `name` = :name,
                    `company` = :company,
                    `genre` = :genre,
                    `year_of_release` = :year_of_release,
                     `score` = :score
                    ";
            $query = $connection->prepare($sql);
        try {
            $query->execute(array(
                'name'            => $_POST['name'],
                'company'         => $_POST['company'],
                'genre'           => $_POST['genre'],
                'year_of_release' => $_POST['year_of_release'],
                'score'           => $_POST['score']
            ));
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}
