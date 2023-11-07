<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class DeletePlayerController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = new PlayerResource();
        $resource->delete($id);

        $this->redirectTo('/admin-players');
    }
}
