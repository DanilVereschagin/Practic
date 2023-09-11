<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class AdminGamesBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/admin-games.phtml';
    }

    /**
     * @return false|\PDOStatement
     */
    public function getGames(): \PDOStatement
    {
        $db = new Database();
        $connection = $db->getConnection();
        $games = $connection->query('select * from game;');

        return $games;
    }
}
