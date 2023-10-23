<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

class DogApiService extends AbstractWebApiService
{
    public function getDog()
    {
        $res = $this->getApiResponse('https://random.dog/woof.json');

        if ($res) {
            return $res;
        }

        return [];
    }
}
