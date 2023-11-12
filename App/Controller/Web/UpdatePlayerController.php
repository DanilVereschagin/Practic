<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Factory\ResourceFactory;
use App\Model\Session;
use Laminas\Di\Di;

class UpdatePlayerController extends AbstractWebController
{
    protected $factory;
    public function __construct(Di $di, ResourceFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        if (!$this->isPost()) {
            $this->sendNotAllowedMethodError();
        }

        $post = $this->getPostValues(['id', 'name', 'surname', 'username', 'mail', 'fake_hour', 'is_admin']);
        $resource = $this->factory->create('player', ['di' => $this->di]);
        $player = $resource->getByMail($post['mail']);

        if ($player->getId() != $post['id'] && $player->getMail() == $post['mail']) {
            $this->session->setMessage('Данный email уже занят');
            $this->redirectTo('/error');
        }

        if (!$this->session->IsAdmin() == 1) {
            $post['is_admin'] = $this->session->IsAdmin();
            $resource->update($post);
            $this->redirectTo('/player');
        } else {
            $resource->update($post);
            $this->redirectTo('/admin-players');
        }
    }
}
