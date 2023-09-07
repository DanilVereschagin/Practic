<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class MainBlock
{
    public function render()
    {
        require_once APP_ROOT . '/view/template/main.phtml';
    }

    public function getAllPlayer(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $array = $connection->query('Select * from player');
        return $array;
    }
}
