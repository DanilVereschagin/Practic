<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\Exception\HttpRedirectException;
use App\Model\Session;
use App\Model\SessionChecker;
use Laminas\Di\Di;

class AuthCheckMiddleware implements MiddlewareInterface
{
    protected MiddlewareInterface $next;
    protected $session;
    protected $observer;

    public function __construct(Session $session, SessionChecker $sessionChecker)
    {
        $this->session = $session;
        $this->observer = $sessionChecker;
    }

    public function getNext()
    {
        return $this->next ?? null;
    }

    public function setNext(MiddlewareInterface $handle)
    {
        $this->next = $handle;
    }

    public function handle(string $route)
    {
        $this->session->start();

        if ($this->session->getClientId() !== null) {
            return $route;
        }

        $isGuessPage = $this->observer->isGuestPages($route);

        if (!$isGuessPage) {
            throw new HttpRedirectException('/login');
        }

        if ($this->getNext() !== null) {
            $this->next($route);
        }
    }

    protected function next(string $route)
    {
        $nextHandler = $this->getNext();
        if ($nextHandler) {
            $nextHandler->handle($route);
        }
    }
}
