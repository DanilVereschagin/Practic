<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\DogApiService;
use Laminas\Di\Di;

class MainBlock extends AbstractBlock
{
    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/main.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllPlayer(): array
    {
        $playerResource = $this->di->get(PlayerResource::class, ['di' => $this->di]);
        return $playerResource->getAll();
    }

    public function getDog()
    {
        $service = $this->di->get(DogApiService::class);
        $dog = $service->getDog();

        return $dog;
    }
}
