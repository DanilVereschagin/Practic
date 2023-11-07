<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class DeleteGameController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new GameResource();
        $resource->delete($id);

        $this->redirectTo('/admin-games');
    }
}
