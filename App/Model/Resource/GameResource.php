<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Game;

class GameResource
{
    /**
     * @return Game[]
     */
    public function getAll(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.id, player.username, game.name, company.name as Company 
                   from player 
                   left join library on player.id = library.username 
                   left join game on library.name_of_game = game.id 
                   left join company on company.id = game.company 
                   where player.id = :ID order by player.id;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $this->id]);
        $games = $query->fetchAll();
    }

    /**
     * @param int $id
     * @return Game[]
     */
    public function getLibraryGames(int $id): array
    {
        $db = new Database();
        $connection = $db->getConnection();
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
            $game = new Game($row);
            $games[] = $game;
        }

        return $games;
    }

    /**
     * @return Game
     */
    public function getById(): Game
    {
        return new Game();
    }
}
