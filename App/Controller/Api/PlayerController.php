<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\PlayerBlock;
use App\Controller\Web\AbstractWebController;
use App\Model\Resource\PlayerResource;
use App\Model\Session;

class PlayerController extends AbstractApiController
{
    public function execute()
    {
        $id = $this->getIdParam();

        if ($id == 0) {
            $id = Session::getClientId();
        }

        $resource = new PlayerResource();
        $player = $resource->getById($id);

        header('Content-Type: application/json');
        echo json_encode(($player));
    }
}