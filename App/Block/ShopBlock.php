<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class ShopBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/shop.phtml';
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
