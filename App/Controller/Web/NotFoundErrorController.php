<?php

declare(strict_types=1);

namespace App\Controller\Web;

class NotFoundErrorController
{
    public function execute()
    {
        require_once APP_ROOT . '/html/404.html';
    }
}
