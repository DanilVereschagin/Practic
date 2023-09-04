<?php

declare(strict_types=1);

namespace App\Block;

class PlayerBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/player.phtml';
    }

    public function getNickname()
    {
        return 'Abyss';
    }

    public function getFIO()
    {
        return 'Верещагин' . PHP_EOL . 'Данил' . PHP_EOL . 'Олегович';
    }

    public function getFakeHours()
    {
        return 100;
    }

    public function getRegisterDate()
    {
        return '22-07-23';
    }
}
