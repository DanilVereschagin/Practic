<?php

declare(strict_types=1);

namespace App\Controller;

use App\API\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    abstract public function execute();

    protected function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        } else {
            return false;
        }
    }

    protected function redirectTo(string $url)
    {
        header($url, true, 302);
    }

    protected function getQueryParams(): array
    {
        return $_GET ?? [];
    }

    protected function getQueryParam(string $param): ?string
    {
        $array = $this->getQueryParams() ?? null;
        return $array[$param];
    }

    protected function getPostParams(): array
    {
        return $_POST ?? [];
    }
}
