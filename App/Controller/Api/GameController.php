<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\GameBlock;
use App\Controller\Web\AbstractWebController;
use App\Model\Resource\CommentResource;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\GameResource;

class GameController extends AbstractApiController
{
    public function execute()
    {
        $id = $this->getIdParam();

        $resource = new GameResource();
        $game = $resource->getComplexInfoById($id);

        $resource = new CommentResource();
        $comment = $resource->getParentComments($id);
        $childComment = $resource->getChildComments($id);

        header('Content-Type: application/json');
        echo json_encode(['game' => $game, 'comment' => $comment, 'childComment' => $childComment]);
    }
}
