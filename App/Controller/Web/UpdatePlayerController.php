<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class UpdatePlayerController extends AbstractWebController
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

        $post = $this->getPostValues(['id', 'name', 'surname', 'username', 'mail', 'fake_hour', 'is_admin']);
        $resource = new PlayerResource();
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && $player->getMail() == $post['mail']) {
            Session::setMessage('Данный email уже занят');
            $this->redirectTo('/error');
        }

        if (!Session::IsAdmin() == 1) {
            $post['is_admin'] = Session::IsAdmin();
            $resource->update($post);
            $this->redirectTo('/player');
        } else {
            $resource->update($post);
            $this->redirectTo('/admin-players');
        }
    }
}
