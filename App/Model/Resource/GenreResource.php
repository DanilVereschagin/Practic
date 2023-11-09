<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Model\Database;
use App\Model\Genre;
use Laminas\Di\Di;

class GenreResource extends AbstractResource
{
    protected string $table = 'genre';
    protected $di;

    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    /**
     * @param string|null $name
     * @return Genre
     */
    public function getByName(?string $name): Genre
    {
        $connection = Database::getInstance();
        $sql = 'select * from genre where genre.name_of_genre = :name;';
        $query = $connection->prepare($sql);
        $query->execute(['name' => $name]);
        $genreInfo = $query->fetch();

        $genre = $this->di->get(Genre::class, ['data' => $genreInfo]);

        return $genre;
    }
}
