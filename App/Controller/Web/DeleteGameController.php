<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Resource\GameResource;
use App\Model\Session;
use Laminas\Di\Di;

class DeleteGameController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, ResourceFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
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
