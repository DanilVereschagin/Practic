<?php

declare(strict_types=1);

namespace App\Model;

class Genre
{
    protected ?int $id;
    protected ?string $nameOfGenre;

    public function __construct(?array $data = [])
    {
        $this->setId($data['genre_id']);
        $this->setNameOfGenre($data['name_of_genre']);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNameOfGenre(): ?string
    {
        return $this->nameOfGenre;
    }

    public function setNameOfGenre(?string $nameOfGenre)
    {
        $this->nameOfGenre = $nameOfGenre;
        return $this;
    }
}
