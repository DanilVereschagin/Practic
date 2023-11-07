<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\CommentResource;
use App\Model\Session;
use Laminas\Di\Di;

class AddCommentController extends AbstractWebController
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

        $id = $this->getIdParam();

        $postParams = $this->getPostParams();
        $post = [
            'text_of_comment'    => $postParams['message'],
            'username'           => Session::getClientId(),
            'game'               => $id,
            'date_of_writing'    => date('Y-m-d h:i:s'),
        ];

        $resource = new CommentResource();
        $resource->add($post);

        $this->redirectTo('/game?id=' . $id);
    }
}
