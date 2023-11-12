<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class AddGameController extends AbstractWebController
{
    protected $factory;
    public function __construct(Di $di, ResourceFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['name', 'company', 'genre', 'year_of_release', 'score', 'description']);
        $resource = $this->factory->create('game', ['di' => $this->di]);
        $resource->add($post);

        $this->redirectTo('/admin-games');
    }
}
