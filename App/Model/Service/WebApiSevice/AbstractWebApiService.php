<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use GuzzleHttp\Client;
use Laminas\Di\Di;

abstract class AbstractWebApiService
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
}
