<?php

declare(strict_types=1);

namespace App\Controller;

use App\Middleware\CacheMiddleware;
use App\Model\Exception\HttpMethodNotAllowedException;
use App\Model\Exception\HttpRedirectException;
use App\Model\Session;
use App\Ui\ControllerInterface;
use Laminas\Di\Di;

abstract class AbstractController implements ControllerInterface
{
    protected $di;
    protected $session;

    public function __construct(Di $di, Session $session)
    {
        $this->di = $di;
        $this->session = $session;
        $this->getCache();
        $this->protectFromCsrf();
    }

    abstract public function execute();

    protected function getCache()
    {
        $url = $this->getUri();

        if (strpos($url, 'api') === false) {
            return;
        }

        $cacheMiddleware = $this->di->get(CacheMiddleware::class, ['di' => $this->di]);
        $cacheMiddleware->handle($this->getUri());
    }

    protected function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

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

    public function isPut(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
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

    protected function getRowBody()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    protected function responseSuccessJson($data, $status = 200)
    {
        header('Content-Type: application/json');
        if ($status !== 200) {
            http_response_code($status);
        }
        echo json_encode($data);
        exit;
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
        $postCsrfToken = $this->getPostParam('csrf_token');

        if ($postCsrfToken === '') {
            $post = $this->getRowBody();
            $postCsrfToken = $post['csrf_token'] ?? null;
        }

        if (!$postCsrfToken) {
            return;
        }

        $csrfToken = $this->session->getCsrfToken();

        if ($postCsrfToken !== $csrfToken) {
            $this->session->setMessage('Да ты тут самый умный, я смотрю...');
            $this->redirectTo('/error');
        }
    }
}
