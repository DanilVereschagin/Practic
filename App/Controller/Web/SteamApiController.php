<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\ShopBlock;
use GuzzleHttp\Client;

class SteamApiController extends AbstractWebController
{
    public function execute()
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
                    $games[] = $resourceInfo;
                    $i++;
                }
                $j++;
            }

            die;
        }

        $block = new ShopBlock();
        $block->render();
    }
}
