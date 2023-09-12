<?php

declare(strict_types=1);

namespace App\Model;

class Game
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $company;
    protected ?int $genre;
    protected ?string $year_of_release;
    protected ?float $score;

    public function __construct(?array $data = [])
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setCompany($data['company']);
        $this->setGenre($data['genre']);
        $this->setYearOfRelease($data['year_of_release']);
        $this->setScore($data['score']);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCompany(): ?int
    {
        return $this->company;
    }

    public function setCompany(?int $company): void
    {
        $this->company = $company;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(?int $genre): void
    {
        $this->genre = $genre;
    }

    public function getYearOfRelease(): ?string
    {
        return $this->year_of_release;
    }

    public function setYearOfRelease(?string $year_of_release): void
    {
        $this->year_of_release = $year_of_release;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(?float $score): void
    {
        $this->score = $score;
    }
}
