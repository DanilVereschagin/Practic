<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Genre;

class GenreResource extends AbstractResource
{
    /**
     * @param int|null $id
     * @return Genre
     */
    public function getById(?int $id): Genre
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from genre where genre.genre_id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $genreInfo = $query->fetch();

        $genre = new Genre($genreInfo);

        return $genre;
    }

    /**
     * @param string|null $name
     * @return Genre
     */
    public function getByName(?string $name): Genre
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from genre where genre.name_of_genre = :name;';
        $query = $connection->prepare($sql);
        $query->execute(['name' => $name]);
        $genreInfo = $query->fetch();

        $genre = new Genre($genreInfo);

        return $genre;
    }
}
