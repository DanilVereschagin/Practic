<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Factory\EntityFactory;
use App\Model\Database;
use App\Model\Player;
use Laminas\Di\Di;

class PlayerResource extends AbstractResource
{
    protected string $table = 'player';
    protected $entityFactory;

    public function __construct(Di $di, Database $database, EntityFactory $entityFactory)
    {
        parent::__construct($di, $database);
        $this->entityFactory = $entityFactory;
    }

    /**
     * @return Player[]
     */
    public function getAllPlayers(): array
    {
        $rowset = $this->connection->query('Select * from player where is_admin = 0');

        $players = [];
        foreach ($rowset as $row) {
            $player = $this->entityFactory->create('player', ['data' => $row]);
            $players[] = $player;
        }

        return $players;
    }

    /**
     * @return Player[]
     */
    public function getAllAdmins(): array
    {
        $rowset = $this->connection->query('Select * from player where is_admin = 1');

        $players = [];
        foreach ($rowset as $row) {
            $player = $this->entityFactory->create('player', ['data' => $row]);
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
        $sql = 'select * from player where `mail` = :mail';
        $query = $this->connection->prepare($sql);
        $query->execute(['mail' => $mail]);
        $info = $query->fetch();

        if (!$info) {
            $info = [];
        }

        return $this->entityFactory->create('player', ['data' => $info]);
    }

    public function update(array $post)
    {
        $sql = 'update player
                    set `name` = :name,
                    `surname` = :surname,
                    `username` = :username,
                    `mail` = :mail,
                    `fake_hour` = :fake_hour,
                    `is_admin` = :is_admin
                    where player.id = :ID
                    ';
        $query = $this->connection->prepare($sql);
        $this->prepareDataOfPlayer($query, $post);
        $query->execute();
    }

    public function add(array $post)
    {
        $sql = 'insert into player
                    set `name` = :name,
                    `surname` = :surname,
                    `username` = :username,
                    `mail` = :mail,
                    `date_of_registration` = :date,
                    `fake_hour` = :fake_hour,
                    `is_admin` = :is_admin,
                    `password` = :password
                    ';
        $query = $this->connection->prepare($sql);
        $this->prepareDataOfPlayer($query, $post);
        $query->execute();
    }

    protected function prepareDataOfPlayer(\PDOStatement $query, array $post)
    {
        if (array_key_exists('name', $post)) {
            $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        }
        if (array_key_exists('surname', $post)) {
            $query->bindValue('surname', $post['surname'], \PDO::PARAM_STR);
        }
        if (array_key_exists('username', $post)) {
            $query->bindValue('username', $post['username'], \PDO::PARAM_STR);
        }
        if (array_key_exists('mail', $post)) {
            $query->bindValue('mail', $post['mail'], \PDO::PARAM_STR);
        }
        if (array_key_exists('date_of_registration', $post)) {
            $query->bindValue('date', $post['date_of_registration'], \PDO::PARAM_STR);
        }
        if (array_key_exists('fake_hour', $post)) {
            $query->bindValue('fake_hour', $post['fake_hour'], \PDO::PARAM_INT);
        }
        if (array_key_exists('is_admin', $post)) {
            $query->bindValue('is_admin', $post['is_admin'], \PDO::PARAM_STR);
        }
        if (array_key_exists('password', $post)) {
            $query->bindValue('password', $post['password'], \PDO::PARAM_STR);
        }
        if (array_key_exists('id', $post)) {
            $query->bindValue('ID', $post['id'], \PDO::PARAM_INT);
        }
    }
}
