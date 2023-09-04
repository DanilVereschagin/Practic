<?php

declare(strict_types=1);

namespace App\Block;

use App\Block\PlayerBlock;

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
        return [
            'Minecraft',
            'Fallout 4',
            'For Honor',
            'Counter-Strike: Global Offensive',
            'Dota 2'
        ];
    }
}
