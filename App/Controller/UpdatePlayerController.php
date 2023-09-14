<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;
use App\Model\Resource\PlayerResource;

class UpdatePlayerController extends AbstractController
{
    public function execute()
    {
        $id = (int)$this->getQueryParam('id');
        if ($this->isPost()) {
            $postParams = $this->getPostParams();
            $post =  [
                'id'        => $postParams['id'],
                'name'      => $postParams['name'],
                'surname'   => $postParams['surname'],
                'username'  => $postParams['username'],
                'fake_hour' => $postParams['fake_hour'],
                'is_admin'  => $postParams['is_admin']
            ];

            (new PlayerResource())->update($post);
        }

        $this->redirectTo("Location: /admin-players");
    }
}