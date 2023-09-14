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

    /**
     * @return Player[]
     */
    public function getAllPlayers(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $rowset = $connection->query('Select * from player where is_admin = 0');

        $players = [];
        foreach ($rowset as $row) {
            $player = new Player($row);
            $players[] = $player;
        }

        return $players;
    }

    /**
     * @return Player[]
     */
    public function getAllAdmins(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $rowset = $connection->query('Select * from player where is_admin = 1');

        $players = [];
        foreach ($rowset as $row) {
            $player = new Player($row);
            $players[] = $player;
        }

        return $players;
    }

    public function update(array $post)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "update player
                    set `name` = :name,
                    `surname` = :surname,
                    `username` = :username,
                    `fake_hour` = :fake_hour,
                    `is_admin` = :is_admin
                    where player.id = :id
                    ";
        $query = $connection->prepare($sql);
        $this->prepareDataOfPlayer($query, $post);
        $query->execute();
    }

    protected function prepareDataOfPlayer(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('surname', $post['surname'], \PDO::PARAM_STR);
        $query->bindValue('username', $post['username'], \PDO::PARAM_STR);
        $query->bindValue('fake_hour', $post['fake_hour'], \PDO::PARAM_STR);
        $query->bindValue('is_admin', $post['is_admin'], \PDO::PARAM_STR);
        $query->bindValue('id', $post['id'], \PDO::PARAM_INT);
    }
}
