<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Database;

class PlayerBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/player.phtml';
    }

    public function getPlayerInfo(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select * from player where player.id = :ID;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => ID]);
        $info = $query->fetchAll();
        return $info;
    }
}
