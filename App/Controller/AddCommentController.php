<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\CommentResource;

class AddCommentController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post = [
                'name'    => $postParams['name'],
                'type'    => $postParams['type'],
                'address' => $postParams['address'],
            ];

            (new CommentResource())->add($post);
        }
        $this->redirectTo('Location: /companies');
    }
}