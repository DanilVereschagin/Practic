<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class EditPlayerBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-player.phtml';
    }

    public function getPlayerInfo(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.id,
                player.name, 
                player.surname, 
                player.username, 
                player.fake_hour, 
                player.is_admin
                from player
                where player.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $this->id]);
        $playerInfo = $query->fetchAll();

        return $playerInfo;
    }

    public function updatePlayer(array $post)
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
        try {
            $this->prepareDataOfPlayer($query, $post);
            $query->execute();
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
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
