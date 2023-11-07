<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class UpdateGameController extends AbstractWebController
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['id', 'name', 'company', 'genre', 'year_of_release', 'score', 'description']);
        $resource = new GameResource();
        $resource->update($post);

        $this->redirectTo('/admin-games');
    }
}
