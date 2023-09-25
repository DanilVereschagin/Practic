<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Player;

class PlayerResource extends AbstractResource
{
    protected string $table = "player";

    /**
     * @return Player[]
     */
    public function getAllPlayers(): array
    {
        $connection = Database::getInstance();
        $rowset = $connection->query("Select * from player where is_admin = 0");

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
        $connection = Database::getInstance();
        $rowset = $connection->query("Select * from player where is_admin = 1");

        $players = [];
        foreach ($rowset as $row) {
            $player = new Player($row);
            $players[] = $player;
        }

        return $players;
    }

    /**
     * @param $mail
     * @return Player
     */
    public function getByMail($mail): Player
    {
        $connection = Database::getInstance();
        $sql = "select * from player where `mail` = :mail";
        $query = $connection->prepare($sql);
        $query->execute(["mail" => $mail]);
        $info = $query->fetch();

        return new Player($info);
    }

    public function update(array $post)
    {
        $connection = Database::getInstance();
        $sql = "update player
                    set `name` = :name,
                    `surname` = :surname,
                    `username` = :username,
                    `mail` = :mail,
                    `fake_hour` = :fake_hour,
                    `is_admin` = :is_admin
                    where player.id = :ID
                    ";
        $query = $connection->prepare($sql);
        $this->prepareDataOfPlayer($query, $post);
        $query->execute();
    }

    public function add(array $post)
    {
        $connection = Database::getInstance();
        $sql = "insert into player
                    set `name` = :name,
                    `surname` = :surname,
                    `username` = :username,
                    `mail` = :mail,
                    `date_of_registration` = :date,
                    `fake_hour` = :fake_hour,
                    `is_admin` = :is_admin,
                    `password` = :password
                    ";
        $query = $connection->prepare($sql);
        $this->prepareDataOfPlayer($query, $post);
        $query->execute();
    }

    protected function prepareDataOfPlayer(\PDOStatement $query, array $post)
    {
        if (array_key_exists("name", $post)) {
            $query->bindValue("name", $post["name"], \PDO::PARAM_STR);
        }
        if (array_key_exists("surname", $post)) {
            $query->bindValue("surname", $post["surname"], \PDO::PARAM_STR);
        }
        if (array_key_exists("username", $post)) {
            $query->bindValue("username", $post["username"], \PDO::PARAM_STR);
        }
        if (array_key_exists("mail", $post)) {
            $query->bindValue("mail", $post["mail"], \PDO::PARAM_STR);
        }
        if (array_key_exists("date_of_registration", $post)) {
            $query->bindValue("date", $post["date_of_registration"], \PDO::PARAM_STR);
        }
        if (array_key_exists("fake_hour", $post)) {
            $query->bindValue("fake_hour", $post["fake_hour"], \PDO::PARAM_INT);
        }
        if (array_key_exists("is_admin", $post)) {
            $query->bindValue("is_admin", $post["is_admin"], \PDO::PARAM_STR);
        }
        if (array_key_exists("password", $post)) {
            $query->bindValue("password", $post["password"], \PDO::PARAM_STR);
        }
        if (array_key_exists("id", $post)) {
            $query->bindValue("ID", $post["id"], \PDO::PARAM_INT);
        }
    }
}
