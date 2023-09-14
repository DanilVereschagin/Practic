<?php

declare(strict_types=1);

namespace App\Model;

class Genre
{
    protected ?int $id;
    protected ?string $name_of_genre;

    public function __construct(?array $data = [])
    {
        $this->setId($data['genre_id']);
        $this->setNameOfGenre($data['name_of_genre']);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNameOfGenre(): ?string
    {
        return $this->name_of_genre;
    }

    public function setNameOfGenre(?string $name_of_genre): void
    {
        $this->name_of_genre = $name_of_genre;
    }
}
