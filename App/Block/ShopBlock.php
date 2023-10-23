<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;
use App\Model\Service\WebApiSevice\DogApiService;

class ShopBlock extends AbstractBlock
{
    protected array $games;

    public function __construct(array $games)
    {
        $this->games = $games;
    }
    public function renderTemplate()
    {
        require_once APP_ROOT . '/view/template/shop.phtml';
    }

    /**
     * @return Game[]
     */
    public function getGames(): array
    {
        $gameResource = new GameResource();
        $orionGames = $gameResource->getAll();

        foreach ($orionGames as $game) {
            $this->games[] = ['game' => $game, 'orion' => true];
        }

        return $this->games;
    }
}
