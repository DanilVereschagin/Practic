<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class UpdateGameController extends AbstractApiController
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
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
        $resource->update($post);

        $gameRepository = $this->repositoryFactory->create('game', ['di' => $this->di]);
        $gameRepository->initCache($this->getUri());

        $game = $resource->getById($post['id']);

        $this->responseSuccessJson($game);
    }
}
