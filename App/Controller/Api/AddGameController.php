<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Factory\ResourceFactory;
use App\Model\Repository\GameRepository;
use App\Model\Session;
use Laminas\Di\Di;

class AddGameController extends AbstractApiController
{
    protected $resourceFactory;
    protected $repositoryFactory;
    public function __construct(
        Di $di,
        ResourceFactory $resourceFactory,
        RepositoryFactory $repositoryFactory,
        Session $session
    ) {
        parent::__construct($di, $session);
        $this->resourceFactory = $resourceFactory;
        $this->repositoryFactory = $repositoryFactory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
        $resource->add($post);

        $gameRepository = $this->repositoryFactory->create('game', ['di' => $this->di]);
        $gameRepository->initCache($this->getUri());

        $game = $resource->getByName($post['name']);

        $this->responseSuccessJson($game, 201);
    }
}
