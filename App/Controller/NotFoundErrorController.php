<?php

declare(strict_types=1);

namespace App\Controller;

class NotFoundErrorController
{
    public function execute()
    {
        require_once APP_ROOT . '/src/html/404.html';
    }
}
