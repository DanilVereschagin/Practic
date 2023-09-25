<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\ControllerInterface;
use App\Model\Session;

abstract class AbstractController implements ControllerInterface
{
    public function __construct()
    {
        Session::start();
    }

    abstract public function execute();

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function redirectTo(string $url)
    {
        header("Location: " . $url, true, 302);
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
        $id = $_GET['id'] ?? null;
        return (int)$id;
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
