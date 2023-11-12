<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class AddCommentController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, ResourceFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
        $this->di = $di;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $id = $this->getIdParam();

        $postParams = $this->getPostParams();
        $post = [
            'text_of_comment'    => $postParams['message'],
            'username'           => $this->session->getClientId(),
            'game'               => $id,
            'date_of_writing'    => date('Y-m-d h:i:s'),
        ];

        $resource = $this->factory->create('comment', ['di' => $this->di]);
        $resource->add($post);

        $this->redirectTo('/game?id=' . $id);
    }
}
