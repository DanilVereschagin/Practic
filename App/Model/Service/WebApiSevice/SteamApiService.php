<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use App\Model\Game;
use Laminas\Di\Di;

class SteamApiService extends AbstractWebApiService
{
    public function __construct(Di $di)
    {
        $this->di = $di;
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
                    $game = $this->di->get(Game::class, ['data' => $app]);
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
