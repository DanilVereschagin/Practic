<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\HttpMethodNotAllowedException;
use App\Model\HttpRedirectException;
use App\Model\Session;
use App\Ui\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    public function __construct()
    {
        $this->protectFromCsrf();
    }

    abstract public function execute();

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isDelete(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    protected function redirectTo(string $url)
    {
        throw new HttpRedirectException($url);
    }

    protected function getQueryParams(): array
    {
        return $this->protectFromXss($_GET) ?? [];
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
        return $this->protectFromXss($_POST) ?? [];
    }

    protected function getPostParam(string $param): string
    {
        return $_POST[$param] ?? '';
    }

    protected function getPostValues(array $names)
    {
        $postParams = $this->getPostParams();

        $post =  [];
        foreach ($names as $name) {
            $post[$name] = $postParams[$name];
        }

        return $this->protectFromXss($post);
    }

    protected function sendNotAllowedMethodError()
    {
        throw new HttpMethodNotAllowedException();
    }

    protected function protectFromXss(array $data)
    {
        $protectedData = [];

        foreach ($data as $datum => $value) {
            $value = strip_tags($value);
            $protectedData[$datum] = htmlspecialchars($value);
        }

        return $protectedData;
    }

    protected function protectFromCsrf()
    {
        if (!(Session::getClientId() && !($this->isGet() || $this->isDelete()))) {
            return;
        }

        $csrfToken = Session::getCsrfToken();
        $postCsrfToken = $this->getPostParam('csrf_token');

        if ($postCsrfToken === '') {
            $post = json_decode(file_get_contents('php://input'), true);
            $postCsrfToken = $post['csrf_token'];
        }

        if ($postCsrfToken !== $csrfToken) {
            Session::setMessage('Да ты тут самый умный, я смотрю...');
            $this->redirectTo('/error');
        }
    }
}
