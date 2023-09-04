<?php

declare(strict_types=1);

namespace App\Block;

use App\Block\PlayerBlock;
use App\Model\Database;

class LibraryBlock
{
    public function render()
    {
        $player = $this->getPlayerInfo();
        require_once APP_ROOT . '/view/template/library.phtml';
    }

    public function getPlayerInfo(): array
    {
        $playerBlock = new PlayerBlock();

        $info = [];
        $info['nickname'] = $playerBlock->getNickname();
        $info['fio'] = $playerBlock->getFIO();
        $info['fake_hour'] = $playerBlock->getFakeHours();
        $info['register_date'] = $playerBlock->getRegisterDate();
        return $info;
    }

    public function getGames()
    {
        $db = new Database();
        $connection = $db->getConnection();
        $array = $connection->query(
            'select player.id, player.username, game.name, company.name as Company 
                   from player 
                   left join library on player.id = library.username 
                   left join game on library.name_of_game = game.id 
                   left join company on company.id = game.company 
                   where player.id = 1 order by player.id;'
        );

        return $array;
    }
}
