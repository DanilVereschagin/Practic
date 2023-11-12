<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\DogApiService;
use Laminas\Di\Di;

class MainBlock extends AbstractBlock
{
    protected $playerResource;
    protected $dogApiService;

    public function __construct(Di $di, PlayerResource $playerResource, DogApiService $dogApiService)
    {
        $this->playerResource = $playerResource;
        $this->dogApiService = $dogApiService;
        parent::__construct($di);
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
        return $this->playerResource->getAll();
    }

    public function getDog()
    {
        $dog = $this->dogApiService->getDog();

        return $dog;
    }
}
