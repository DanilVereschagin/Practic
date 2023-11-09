<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Resource\PlayerResource;
use Laminas\Di\Di;

class DeletePlayerController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, ResourceFactory $factory)
    {
        parent::__construct($di);
        $this->factory = $factory;
        $this->di = $di;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $resource = $this->factory->create('player', ['di' => $this->di]);
        $resource->delete($id);

        $this->redirectTo('/admin-players');
    }
}
