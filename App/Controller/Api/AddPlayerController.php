<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\RepositoryFactory;
use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class AddPlayerController extends AbstractApiController
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
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $player = $resource->getByMail($post['mail']);

        if (!is_null($player->getMail())) {
            http_response_code(400);
            return;
        }

        $playerRepository = $this->repositoryFactory->create('player', ['di' => $this->di]);
        $post = $playerRepository->setDefaultValues($post);
        $resource->add($post);

        $playerRepository->initCache($this->getUri());

        $player = $resource->getByMail($post['mail']);

        $this->responseSuccessJson($player, 201);
    }
}
