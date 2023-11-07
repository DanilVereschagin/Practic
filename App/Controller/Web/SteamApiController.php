<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\SteamApiBlock;
use App\Factory\CacheFactory;
use App\Model\Game;
use App\Model\Service\WebApiSevice\SteamApiService;
use Laminas\Di\Di;

class SteamApiController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $cacheFactory = new CacheFactory();
        $cacheService = $cacheFactory->create();
        $uri = $this->getUri();

        if ($cache = $cacheService->get($uri)) {
            $games = [];
            foreach ($cache as $item) {
                $game = new Game(['id' => $item->id, 'name' => $item->name]);
                $games[] = $game;
            }
        } else {
            $fakeApiService = new SteamApiService();
            $games = $fakeApiService->getGames();
            $cacheService->set($uri, $games);
        }

        $block = new SteamApiBlock($games);
        $block->render();
    }
}
