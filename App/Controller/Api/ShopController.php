<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Model\Repository\GameRepository;
use App\Model\Session;
use Laminas\Di\Di;

class ShopController extends AbstractApiController
{
    protected $repositoryFactory;
    public function __construct(Di $di, RepositoryFactory $repositoryFactory, Session $session)
    {
        parent::__construct($di, $session);
        $this->repositoryFactory = $repositoryFactory;
    }

    public function execute()
    {
        $gameRepository = $this->repositoryFactory->create('game', ['di' => $this->di]);
        $games = $gameRepository->initCache($this->getUri());

        $this->responseSuccessJson(json_encode($games));
    }
}
