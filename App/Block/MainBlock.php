<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\DogApiService;

class MainBlock extends AbstractBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/main.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllPlayer(): array
    {
        $playerResource = new PlayerResource();
        return $playerResource->getAll();
    }

    public function getDog()
    {
        $service = new DogApiService();
        $dog = $service->getDog();

        return $dog;
    }
}
