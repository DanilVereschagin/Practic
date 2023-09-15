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
            (new PlayerResource())->update($post);
        }

        $this->redirectTo("/admin-players");
    }
}
