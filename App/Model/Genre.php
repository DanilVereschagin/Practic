<?php

declare(strict_types=1);

namespace App\Model;

class Genre extends AbstractModel
{
    protected ?int $genreId;
    protected ?string $nameOfGenre;

    public function __construct(?array $data = [])
    {
        $this->setData($data);
    }


    public function getGenreId(): ?int
    {
        return $this->genreId;
    }

    public function setGenreId(?int $genreId)
    {
        $this->genreId = $genreId;
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
