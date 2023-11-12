<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\Session;
use Laminas\Di\Di;

class LogoutController extends AbstractWebController
{
    public function execute()
    {
        Session::destroy();
        $this->redirectTo('/login');
    }
}
