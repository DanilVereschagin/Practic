<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Player;

class PlayerResource
{
    /**
     * @return Player[]
     */
    public function getAll(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $rowset = $connection->query('Select * from player');

        $players = [];
        foreach ($rowset as $row) {
            $player = new Player($row);
            $players[] = $player;
        }

        return $players;
    }

    /**
     * @param int|null $id
     * @return Player
     */
    public function getById(?int $id): Player
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from player where player.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $infoAboutPlayer = $query->fetch();
        $player = new Player($infoAboutPlayer);
        return $player;
    }
}
