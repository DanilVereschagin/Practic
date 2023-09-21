<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Resource\PlayerResource;

class AddPlayerController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['name', 'surname', 'username', 'mail', 'password']);
            $post['date_of_registration'] = date('Y-m-d h:i:s');
            $post['is_admin'] = 0;
            $post['fake_hour'] = 0;
            $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
            $resource = new PlayerResource();
            $resource->add($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo("/login");
    }
}
