<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\PlayerResource;
use App\Model\Service\PasswordService;

class AddPlayerController extends AbstractWebController
{
    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['name', 'surname', 'username', 'mail', 'password']);
        $post['date_of_registration'] = date('Y-m-d h:i:s');
        $post['is_admin'] = 0;
        $post['fake_hour'] = 0;
        $password = new PasswordService();
        $post['password'] = $password->hashPassword($post['password']);
        $resource = new PlayerResource();
        $resource->add($post);

        $this->redirectTo('/login');
    }
}
