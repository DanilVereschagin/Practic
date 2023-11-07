<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Web\AbstractWebController;
use App\Model\Repository\PlayerRepository;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class UpdatePlayerController extends AbstractApiController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPut()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getRowBody();
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && !is_null($player->getMail())) {
            http_response_code(400);
            return;
        }

        $resource->update($post);

        $playerRepository = new PlayerRepository();
        $playerRepository->initCache($this->getUri());

        $player = $resource->getByMail($post['mail']);

        $this->responseSuccessJson($player);
    }
}
