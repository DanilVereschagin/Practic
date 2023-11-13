<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use App\Factory\EntityFactory;
use App\Model\Game;
use Laminas\Di\Di;

class SteamApiService extends AbstractWebApiService
{
    protected $entiryFactory;

    public function __construct(EntityFactory $entityFactory)
    {
        $this->entiryFactory = $entityFactory;
    }

    public function getGames()
    {
        $res = $this->getApiResponse('https://api.steampowered.com/ISteamApps/GetAppList/v2/?format=json');

        if ($res) {
            $games = [];
            foreach ($res['applist']['apps'] as &$app) {
                if ($app['name'] !== '') {
                    $app['id'] = $app['appid'];
                    unset($app['appid']);
                    $game = $this->entiryFactory->create('game', ['data' => $app]);
                    $games[] = $game;
                }

                if (sizeof($games) == 10) {
                    break;
                }
            }

            return $games;
        }

        return [];
    }
}
