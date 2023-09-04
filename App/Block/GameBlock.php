<?php

declare(strict_types=1);

namespace App\Block;

class GameBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/game.phtml';
    }

    public function getGameName()
    {
        return 'Minecraft';
    }

    public function getGameDescription()
    {
        return 'Игра крутая, ну прям ваще!';
    }

    public function getCompanyName()
    {
        return 'Microsoft';
    }

    public function getGenre()
    {
        return 'Песочница';
    }

    public function getComments()
    {
        $comments = [];
        $comments[] = ['player' => 'Gimmy', 'text' => 'Не, ну игры правда топ!', 'time' => '25 минут назад'];
        $comments[] = ['player' => 'Olof', 'text' => 'Под пиво пойдёт', 'time' => '2 дня назад'];
        return $comments;
    }

    public function getChildComments()
    {
        $comments = [];
        $comments[] = ['player' => 'Lucky', 'text' => 'Согласен!', 'time' => '5 минут назад'];
        return $comments;
    }
}
