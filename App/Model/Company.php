<?php

declare(strict_types=1);

namespace App\Model;

class Company
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $type;
    protected ?string $address;

    public function __construct(?array $data = [])
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setAddress($data['address']);
        $this->setType($data['type']);
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }
}
