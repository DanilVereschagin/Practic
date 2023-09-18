<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\ControllerInterface;

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
        header('Location: ' . $url, true, 302);
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

    protected function getIdParam()
    {
        return (int)$_GET['id'];
    }

    protected function getPostParams(): array
    {
        return $_POST ?? [];
    }

    protected function getPostParam(string $param): array
    {
        return $_POST[$param] ?? [];
    }

    protected function getPostValues(array $names)
    {
        $postParams = $this->getPostParams();

        $post =  [];
        foreach ($names as $name) {
            $post[$name] = $postParams[$name];
        }

        return $post;
    }

    protected function sendNotAllowedMethodError()
    {
        http_response_code(405);
        exit;
    }
}
