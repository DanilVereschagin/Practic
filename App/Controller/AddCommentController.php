<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\CommentResource;

class AddCommentController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post = [
                'text_of_comment'    => $postParams['message'],
                'username'           => ID,
                'game'               => $id,
                'date_of_writing'    => date('Y-m-d h:i:s'),
            ];

            (new CommentResource())->add($post);
        }
        $this->redirectTo('Location: /game?id=' . $id);
    }
}