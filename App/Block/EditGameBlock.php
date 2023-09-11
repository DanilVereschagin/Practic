<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class EditGameBlock extends AbstractAdminBlock
{
    protected ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/edit-game.phtml';
    }

    public function getGameInfo(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select game.id,
                game.name, 
                company.name as Company, 
                genre.name_of_genre, 
                game.year_of_release, 
                game.score
                from game
                left join company on company.id = game.company
                left join genre on genre.genre_id = game.genre
                where game.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $this->id]);
        $gameInfo = $query->fetchAll();

        return $gameInfo;
    }

    public function updateGame(array $post)
    {
            $db = new Database();
            $connection = $db->getConnection();
            $sql = "update game
                    set `name` = :name,
                    `company` = :company,
                    `genre` = :genre,
                    `year_of_release` = :year_of_release,
                    `score` = :score
                    where game.name = :Name
                    ";
            $query = $connection->prepare($sql);
        try {
            $this->prepareDataOfGame($query, $post);
            $query->execute();
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }

    protected function prepareDataOfGame(\PDOStatement $query, array $post)
    {
        $query->bindValue('name', $post['name'], \PDO::PARAM_STR);
        $query->bindValue('company', $this->getByCompany($post['company']), \PDO::PARAM_INT);
        $query->bindValue('genre', $this->getByGenre($post['genre']), \PDO::PARAM_INT);
        $query->bindValue('year_of_release', $post['year_of_release'], \PDO::PARAM_STR);
        $query->bindValue('score', $post['score'], \PDO::PARAM_STR);
        $query->bindValue('Name', $post['name'], \PDO::PARAM_STR);
    }

    protected function getByGenre($genre)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select genre.genre_id from genre
                where genre.name_of_genre = :genre;';
        $query = $connection->prepare($sql);
        $query->execute(['genre' => $genre]);
        $gameInfo = $query->fetchAll();

        return $gameInfo[0]['genre_id'];
    }

    protected function getByCompany($company)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select id from company
                where name = :name;';
        $query = $connection->prepare($sql);
        $query->execute(['name' => $company]);
        $gameInfo = $query->fetchAll();

        return $gameInfo[0]['id'];
    }
}
