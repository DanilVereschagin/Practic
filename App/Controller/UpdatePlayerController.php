<?php

declare(strict_types=1);

namespace App\Controller;

use App\Block\EditPlayerBlock;
use App\Model\Resource\PlayerResource;

class UpdatePlayerController extends AbstractController
{
    public function execute()
    {
        if ($this->isPost()) {
            $post = $this->getPostValues(['id', 'name', 'surname', 'username', 'mail', 'fake_hour', 'is_admin']);
            $resource = new PlayerResource();
            $resource->update($post);
        } else {
            $this->sendNotAllowedMethodError();
        }

        $this->redirectTo("/admin-players");
    }
}
