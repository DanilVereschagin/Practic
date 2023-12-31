<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class DeleteGameController extends AbstractApiController
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
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
        $resource->delete($id);

        $gameRepository = $this->repositoryFactory->create('game', ['di' => $this->di]);
        $gameRepository->deleteCache($this->getUri());

        header('Content-Type: application/json');
    }
}
