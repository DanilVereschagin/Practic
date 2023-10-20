<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use App\Model\Game;
use GuzzleHttp\Client;

class SteamApiService
{
    protected function getApiResponse(string $uri)
    {
        $client = new Client();
        $res = $client->get($uri);

        if ($res->getStatusCode() === 200) {
            return json_decode($res->getBody()->getContents(), true);
        }

        return null;
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
                    $game = new Game($app);
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
