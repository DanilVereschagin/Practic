<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class MainBlock
{
    public function render()
    {
        require APP_ROOT . '/view/layout/player-layout.phtml';
    }

    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/main.phtml';
    }

    public function getAllPlayer(): \PDOStatement
    {
        $db = new Database();
        $connection = $db->getConnection();
        $array = $connection->query('Select player.username from player');
        return $array;
    }
}
