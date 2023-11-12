<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Web\AbstractWebController;
use App\Factory\RepositoryFactory;
use App\Factory\ResourceFactory;
use App\Model\Repository\PlayerRepository;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class UpdatePlayerController extends AbstractApiController
{
    protected $resourceFactory;
    protected $repositoryFactory;

    public function __construct(Di $di, ResourceFactory $resourceFactory, RepositoryFactory $repositoryFactory)
    {
        parent::__construct($di);
        $this->resourceFactory = $resourceFactory;
        $this->repositoryFactory = $repositoryFactory;
    }

    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && !is_null($player->getMail())) {
            http_response_code(400);
            return;
        }

        $resource->update($post);

        $playerRepository = $this->repositoryFactory->create('player', ['di' => $this->di]);
        $playerRepository->initCache($this->getUri());

        $player = $resource->getByMail($post['mail']);

        $this->responseSuccessJson($player);
    }
}
