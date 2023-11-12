<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Block\AdminEditPlayerBlock;
use App\Block\EditPlayerBlock;
use App\Factory\BlockFactory;
use App\Model\Session;
use Laminas\Di\Di;

class EditPlayerController extends AbstractWebController
{
    protected $factory;

    public function __construct(Di $di, BlockFactory $factory, Session $session)
    {
        parent::__construct($di, $session);
        $this->factory = $factory;
    }

    public function execute()
    {
        $id = $this->getIdParam();
        $clientId = $this->session->getClientId();

        if ($id == $clientId) {
            $block = $this->factory->create('editPlayer', ['id' => $id, 'di' => $this->di]);
            $block->render();
        } elseif ($this->session->IsAdmin()) {
            $block = $this->factory->create('adminEditPlayer', ['id' => $id, 'di' => $this->di]);
            $block->render();
        } else {
            $this->redirectTo('/player?id=' . $id);
        }
    }
}
