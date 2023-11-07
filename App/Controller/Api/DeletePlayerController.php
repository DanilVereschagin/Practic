<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Repository\PlayerRepository;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class DeletePlayerController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isDelete()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();
        $resource = new PlayerResource();
        $resource->delete($id);

        $playerRepository = new PlayerRepository();
        $playerRepository->deleteCache($this->getUri());

        header('Content-Type: application/json');
    }
}
