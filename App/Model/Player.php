<?php

declare(strict_types=1);

namespace App\Model;

class Player
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $surname;
    protected ?string $username;
    protected ?string $mail;
    protected ?string $date_of_registration;
    protected ?float $fake_hour;
    protected ?int $is_admin;

    public function __construct(?array $data = [])
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setSurname($data['surname']);
        $this->setUsername($data['username']);
        $this->setMail($data['mail']);
        $this->setDateOfRegistration($data['date_of_registration']);
        $this->setFakeHour($data['fake_hour']);
        $this->setIsAdmin($data['is_admin']);
    }


    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): ?string
    {
        return $this->surname ?? null;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function getUsername(): ?string
    {
        return $this->username ?? null;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getMail(): ?string
    {
        return $this->mail ?? null;
    }

    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    public function getDateOfRegistration(): ?string
    {
        return $this->date_of_registration ?? null;
    }

    public function setDateOfRegistration(?string $date_of_registration): void
    {
        $this->date_of_registration = $date_of_registration;
    }

    public function getFakeHour(): ?float
    {
        return $this->fake_hour ?? null;
    }

    public function setFakeHour(?float $fake_hour): void
    {
        $this->fake_hour = $fake_hour;
    }

    public function getIsAdmin(): ?int
    {
        return $this->is_admin ?? null;
    }

    public function setIsAdmin(?int $is_admin): void
    {
        $this->is_admin = $is_admin;
    }
}
