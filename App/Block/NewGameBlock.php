<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class NewGameBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/newgame.phtml';
    }

    public function addGame(array $post)
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
            $query->execute([
                'name'            => $post['name'],
                'company'         => $post['company'],
                'genre'           => $post['genre'],
                'year_of_release' => $post['year_of_release'],
                'score'           => $post['score']
                ]);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}
