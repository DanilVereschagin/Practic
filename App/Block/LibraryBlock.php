<?php

declare(strict_types=1);

namespace App\Block;

use App\Block\PlayerBlock;
use App\Model\Database;

class LibraryBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        $player = $this->getPlayerInfo();
        require_once APP_ROOT . '/view/template/library.phtml';
    }

    public function getPlayerInfo(): array
    {
        $playerBlock = new PlayerBlock();

        $info = $playerBlock->getPlayerInfo();
        return $info;
    }

    public function getGames(): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.id, player.username, game.name, company.name as Company 
                   from player 
                   left join library on player.id = library.username 
                   left join game on library.name_of_game = game.id 
                   left join company on company.id = game.company 
                   where player.id = :ID order by player.id;';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => ID]);
        $games = $query->fetchAll();

        return $games;
    }
}
