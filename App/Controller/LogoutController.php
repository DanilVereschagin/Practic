<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Session;

class LogoutController extends AbstractController
{
    public function execute()
    {
        Session::destroy();
        $this->redirectTo('/login');
    }
}
