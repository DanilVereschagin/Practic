<?php

declare(strict_types=1);

namespace App\Block;

use App\Model\Player;
use App\Model\Resource\PlayerResource;
use App\Model\Session;
use Laminas\Di\Di;

class AdminBlock extends AbstractAdminBlock
{
    protected $playerResource;

    public function __construct(Di $di, PlayerResource $playerResource, Session $session)
    {
        parent::__construct($di, $session);
        $this->playerResource = $playerResource;
    }

    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/admin.phtml';
    }

    /**
     * @return Player[]
     */
    public function getAllAdmins(): array
    {
        return $this->playerResource->getAllAdmins();
    }
}
