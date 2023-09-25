<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Genre;

class GenreResource extends AbstractResource
{
    protected string $table = "genre";

    /**
     * @param string|null $name
     * @return Genre
     */
    public function getByName(?string $name): Genre
    {
        $connection = Database::getInstance();
        $sql = "select * from genre where genre.name_of_genre = :name;";
        $query = $connection->prepare($sql);
        $query->execute(["name" => $name]);
        $genreInfo = $query->fetch();

        $genre = new Genre($genreInfo);

        return $genre;
    }
}
