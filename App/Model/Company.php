<?php

declare(strict_types=1);

namespace App\Model;

class Company extends AbstractModel
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $type;
    protected ?string $address;

    public function __construct(?array $data = [])
    {
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address)
    {
        $this->address = $address;
        return $this;
    }
}
