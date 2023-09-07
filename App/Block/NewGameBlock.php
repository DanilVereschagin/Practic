<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewGameBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/newgame.phtml';
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
