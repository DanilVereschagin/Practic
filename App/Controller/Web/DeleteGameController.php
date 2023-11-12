<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class DeleteGameController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, ResourceFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = $this->factory->create('game', ['di' => $this->di]);
        $resource->delete($id);

        $this->redirectTo('/admin-games');
    }
}
