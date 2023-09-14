<?php

declare(strict_types=1);

namespace App\Model;

class Comment
{
    protected ?int $id;
    protected ?int $game;
    protected ?string $text_of_comment;
    protected ?string $date_of_writing;
    protected ?string $username;
    protected ?int $parent_comment;


    public function __construct(?array $data = [])
    {
        $this->setId($data['id']);
        $this->setUsername($data['username']);
        $this->setGame($data['game']);
        $this->setDateOfWriting($data['date_of_writing']);
        $this->setTextOfComment($data['text_of_comment']);
        $this->setParentComment($data['parent_comment']);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(?int $game): void
    {
        $this->game = $game;
    }

    public function getTextOfComment(): ?string
    {
        return $this->text_of_comment;
    }

    public function setTextOfComment(?string $text_of_comment): void
    {
        $this->text_of_comment = $text_of_comment;
    }

    public function getDateOfWriting(): ?string
    {
        return $this->date_of_writing;
    }

    public function setDateOfWriting(?string $date_of_writing): void
    {
        $this->date_of_writing = $date_of_writing;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getParentComment(): ?int
    {
        return $this->parent_comment;
    }

    public function setParentComment(?int $parent_comment): void
    {
        $this->parent_comment = $parent_comment;
    }
}
