<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Game;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class FakeApiService
{
    public function getGames()
    {
        $client = new Client();
        $res = $client->get('https://api.steampowered.com/ISteamApps/GetAppList/v2/?format=json');

        if ($res->getStatusCode() === 200) {
            $res = json_decode($res->getBody()->getContents(), true);

            $games = [];
            $j = 0;
            for ($i = 0; $i < 10;) {
                $resourceInfo = $res['applist']['apps'][$j];
                if ($resourceInfo['name'] !== '') {
                    $resourceInfo['id'] = $resourceInfo['appid'];
                    unset($resourceInfo['appid']);
                    $game = new Game($resourceInfo);
                    $games[] = $game;
                    $i++;
                }
                $j++;
            }
        }

        return $games;
    }
}
