<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\HttpRedirectException;
use App\Model\Session;
use App\Model\SessionChecker;

class AuthCheckMiddleware implements MiddlewareInterface
{
    protected AuthCheckMiddleware $next;

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
        Session::start();

        if (Session::getClientId() !== null) {
            return $route;
        }

        $observer = new SessionChecker();
        $isGuessPage = $observer->isGuestPages($route);

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
