<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Model\Session;
use Laminas\Di\Di;

class MainController extends AbstractApiController
{
    protected $repositoryFactory;

    public function __construct(Di $di, RepositoryFactory $repositoryFactory, Session $session)
    {
        parent::__construct($di, $session);
        $this->repositoryFactory = $repositoryFactory;
    }

    public function execute()
    {
        $playerRepository = $this->repositoryFactory->create('player', ['di' => $this->di]);
        $players = $playerRepository->initCache($this->getUri());

        $this->responseSuccessJson(json_encode($players));
    }
}
