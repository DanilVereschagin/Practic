<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\BlockFactory;
use App\Factory\EntityFactory;
use App\Factory\ServiceFactory;
use App\Model\Session;
use Laminas\Di\Di;
use Psr\SimpleCache\CacheInterface;

class ShopController extends AbstractWebController
{
    protected $blockFactory;
    protected $serviceFactory;
    protected $entityFactory;
    protected $cacheService;

    public function __construct(
        Di $di,
        BlockFactory $blockFactory,
        CacheInterface $cacheService,
        ServiceFactory $serviceFactory,
        EntityFactory $entityFactory,
        Session $session
    ) {
        parent::__construct($di, $session);
        $this->blockFactory = $blockFactory;
        $this->cacheService = $cacheService;
        $this->serviceFactory = $serviceFactory;
        $this->entityFactory = $entityFactory;
    }

    public function execute()
    {
        $uri = $this->getUri();

        if ($cache = $this->cacheService->get($uri)) {
            $games = [];
            foreach ($cache as $item) {
                $game = $this->entityFactory->create(
                    'game',
                    [
                        'data' => [
                        'id'   => $item->id,
                        'name' => $item->name
                        ]
                    ]
                );
                $games[] = ['game' => $game, 'orion' => false];
            }
        } else {
            $fakeApiService = $this->serviceFactory->createWebApi('steamApi', ['di' => $this->di]);
            $games = $fakeApiService->getGames();
            $this->cacheService->set($uri, $games);

            foreach ($games as $game) {
                $games[] = ['game' => $game, 'orion' => false];
            }
        }

        $block = $this->blockFactory->create('shop', ['games' => $games, 'di' => $this->di]);
        $block->render();
    }
}
