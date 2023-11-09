<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Company;
use App\Model\Genre;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\GenreResource;
use Laminas\Di\Di;

class Game extends AbstractModel implements \JsonSerializable
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $company;
    protected ?int $genre;
    protected ?string $yearOfRelease;
    protected ?float $score;
    protected ?string $description;
    protected ?Company $companyObject;
    protected ?Genre $genreObject;

    public function __construct(Di $di, ?array $data = [])
    {
        $this->di = $di;
        $this->setData($data);
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCompany(): ?int
    {
        return $this->company;
    }

    public function setCompany(?int $company)
    {
        $this->company = $company;
        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(?int $genre)
    {
        $this->genre = $genre;
        return $this;
    }

    public function getYearOfRelease(): ?string
    {
        return $this->yearOfRelease;
    }

    public function setYearOfRelease(?string $yearOfRelease)
    {
        $this->yearOfRelease = $yearOfRelease;
        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(?float $score)
    {
        $this->score = $score;
        return $this;
    }

    public function getCompanyObject(): ?\App\Model\Company
    {
        return $this->companyObject;
    }

    public function setCompanyObject(?string $companyName)
    {
        if ($companyName == null) {
            $this->companyObject = null;
            return $this;
        }
        $companyResource = $this->di->get(CompanyResource::class, ['di' => $this->di]);
        $this->companyObject = $companyResource->getByName($companyName);

        return $this;
    }

    public function getGenreObject(): ?\App\Model\Genre
    {
        return $this->genreObject;
    }

    public function setGenreObject(?string $nameOfGenre)
    {
        if ($nameOfGenre == null) {
            $this->genreObject = null;
            return $this;
        }
        $genreResource = $this->di->get(GenreResource::class, ['di' => $this->di]);
        $this->genreObject = $genreResource->getByName($nameOfGenre);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function __toArray()
    {
        return call_user_func('get_object_vars', $this);
    }
}
