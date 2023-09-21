<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Game;

class GameResource extends AbstractResource
{
    protected string $table = "game";

    /**
     * @param int $id
     * @return Game[]
     */
    public function getLibraryGames(int $id): array
    {
        $connection = Database::getInstance();
        $sql = 'select player.id as playerId, game.id, game.name
                   from player 
                   left join library on player.id = library.username 
                   left join game on library.name_of_game = game.id 
                   where player.id = :ID order by player.id;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $rowset = $query->fetchAll();

        $games = [];
        foreach ($rowset as $row) {
            unset($row['playerId']);
            $game = new Game($row);
            $games[] = $game;
        }

        return $games;
    }

    /**
     * @param int|null $id
     * @return Game
     */
    public function getComplexInfoById(?int $id): Game
    {
        $connection = Database::getInstance();
        $sql = 'select game.id,
                game.name,
                game.description,
                company.name as CompanyObject,
                genre.name_of_genre as GenreObject,
                game.year_of_release, 
                game.score
                from game
                left join company on company.id = game.company
                left join genre on genre.genre_id = game.genre
                where game.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $gameInfo = $query->fetch();

        $game = new Game($gameInfo);

        return $game;
    }

    public function add(array $post)
    {
        $connection = Database::getInstance();
        $sql = "insert into game
                    set `name` = :name,
                    `company` = :company,
                    `genre` = :genre,
                    `year_of_release` = :year_of_release,
                    `score` = :score,
                    `description` = :description
                    ";
        $query = $connection->prepare($sql);
        $this->prepareDataOfGame($query, $post);
        $query->execute();
    }

    public function update(array $post)
    {
        $connection = Database::getInstance();
        $sql = "update game
                    set `name` = :name,
                    `company` = :company,
                    `genre` = :genre,
                    `year_of_release` = :year_of_release,
                    `score` = :score,
                    `description` = :description
                    where game.id = :ID
                    ";
        $query = $connection->prepare($sql);
        $this->prepareDataOfGame($query, $post);
        $query->execute();
    }

    protected function prepareDataOfGame(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('company', $post['company'], \PDO::PARAM_INT);
        $query->bindValue('genre', $post['genre'], \PDO::PARAM_INT);
        $query->bindValue('year_of_release', $post['year_of_release'], \PDO::PARAM_STR);
        $query->bindValue('score', $post['score'], \PDO::PARAM_STR);
        $query->bindValue('description', $post['description'], \PDO::PARAM_STR);
        if (array_key_exists('id', $post)) {
            $query->bindValue('ID', $post['id'], \PDO::PARAM_INT);
        }
    }
}
