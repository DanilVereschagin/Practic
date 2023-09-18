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
            $post = $this->getPostValues(['id', 'name', 'surname', 'username', 'fake_hour', 'is_admin']);
            $resource = new PlayerResource();
            $resource->update($post);
        } else {
            http_response_code(405);
        }

        $this->redirectTo("/admin-players");
    }
}
