<?php

declare(strict_types=1);

namespace App\Model\Resource;

use App\Factory\EntityFactory;
use App\Model\Database;
use App\Model\Genre;
use Laminas\Di\Di;

class GenreResource extends AbstractResource
{
    protected string $table = 'genre';
    protected $entityFactory;

    public function __construct(Di $di, Database $database, EntityFactory $entityFactory)
    {
        parent::__construct($di, $database);
        $this->entityFactory = $entityFactory;
    }

    /**
     * @param string|null $name
     * @return Genre
     */
    public function getByName(?string $name): Genre
    {
        $sql = 'select * from genre where genre.name_of_genre = :name;';
        $query = $this->connection->prepare($sql);
        $query->execute(['name' => $name]);
        $genreInfo = $query->fetch();

        $genre = $this->entityFactory->create('genre', ['data' => $genreInfo]);

        return $genre;
    }
}
