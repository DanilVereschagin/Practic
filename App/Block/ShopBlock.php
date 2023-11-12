<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Game;
use App\Model\Resource\GameResource;
use App\Model\Service\WebApiSevice\DogApiService;
use Laminas\Di\Di;

class ShopBlock extends AbstractBlock
{
    protected array $games;
    protected $gameResource;

    public function __construct(array $games, Di $di, GameResource $gameResource)
    {
        parent::__construct($di);
        $this->games = $games;
        $this->gameResource = $gameResource;
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
        $orionGames = $this->gameResource->getAll();

        foreach ($orionGames as $game) {
            $this->games[] = ['game' => $game, 'orion' => true];
        }

        return $this->games;
    }
}
