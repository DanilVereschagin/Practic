<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class PlayerController extends AbstractApiController
{
    protected $resourceFactory;

    public function __construct(Di $di, ResourceFactory $resourceFactory, Session $session)
    {
        parent::__construct($di, $session);
        $this->resourceFactory = $resourceFactory;
    }

    public function execute()
    {
        $id = $this->getIdParam();

        if (!$id) {
            $id = $this->session->getClientId();
        }

        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $player = $resource->getById($id);

        $this->responseSuccessJson($player);
    }
}
