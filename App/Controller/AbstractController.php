<?php

declare(strict_types=1);

namespace App\Controller;

use App\API\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    abstract public function execute();

    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public function redirectTo(string $url)
    {
        header($url, true, 302);
    }
}
