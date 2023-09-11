<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class AdminBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/admin.phtml';
    }

    public function getAllPlayer(): \PDOStatement
    {
        $db = new Database();
        $connection = $db->getConnection();
        $array = $connection->query('Select player.username from player where is_admin = 1');
        return $array;
    }
}
