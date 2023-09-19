<?php

declare(strict_types=1);

namespace App\Model;

class Player extends AbstractModel
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $surname;
    protected ?string $username;
    protected ?string $mail;
    protected ?string $dateOfRegistration;
    protected ?float $fakeHour;
    protected ?int $isAdmin;

    public function __construct(?array $data = [])
    {
        $this->setData($data);
    }


    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname ?? null;
    }

    public function setSurname(?string $surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username ?? null;
    }

    public function setUsername(?string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail ?? null;
    }

    public function setMail(?string $mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getDateOfRegistration(): ?string
    {
        return $this->dateOfRegistration ?? null;
    }

    public function setDateOfRegistration(?string $dateOfRegistration)
    {
        $this->dateOfRegistration = $dateOfRegistration;
        return $this;
    }

    public function getFakeHour(): ?float
    {
        return $this->fakeHour ?? null;
    }

    public function setFakeHour(?float $fakeHour)
    {
        $this->fakeHour = $fakeHour;
        return $this;
    }

    public function getIsAdmin(): ?int
    {
        return $this->isAdmin ?? null;
    }

    public function setIsAdmin(?int $isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
}
