<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Block\GameBlock;
use App\Controller\Web\AbstractWebController;
use App\Factory\ResourceFactory;
use App\Model\Resource\CommentResource;
use App\Model\Resource\CompanyResource;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class GameController extends AbstractApiController
{
    protected $resourceFactory;

    public function __construct(Di $di, ResourceFactory $resourceFactory)
    {
        parent::__construct($di);
        $this->resourceFactory = $resourceFactory;
    }

    public function execute()
    {
        $id = $this->getIdParam();

        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
        $game = $resource->getComplexInfoById($id);

        $resource = $this->resourceFactory->create('comment', ['di' => $this->di]);
        $comment = $resource->getParentComments($id);
        $childComment = $resource->getChildComments($id);

        $this->responseSuccessJson(['game' => $game, 'comment' => $comment, 'childComment' => $childComment]);
    }
}
