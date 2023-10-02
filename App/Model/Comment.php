<?php

declare(strict_types=1);

namespace App\Model;

class Comment extends AbstractModel implements \JsonSerializable
{
    protected ?int $id;
    protected ?int $game;
    protected ?string $textOfComment;
    protected ?string $dateOfWriting;
    protected ?string $username;
    protected ?int $parentComment;


    public function __construct(?array $data = [])
    {
        $this->setData($data);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(?int $game)
    {
        $this->game = $game;
        return $this;
    }

    public function getTextOfComment(): ?string
    {
        return $this->textOfComment;
    }

    public function setTextOfComment(?string $textOfComment)
    {
        $this->textOfComment = $textOfComment;
        return $this;
    }

    public function getDateOfWriting(): ?string
    {
        return $this->dateOfWriting;
    }

    public function setDateOfWriting(?string $dateOfWriting)
    {
        $this->dateOfWriting = $dateOfWriting;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getParentComment(): ?int
    {
        return $this->parentComment;
    }

    public function setParentComment(?int $parentComment)
    {
        $this->parentComment = $parentComment;
        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
