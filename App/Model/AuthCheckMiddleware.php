<?php

declare(strict_types=1);

namespace App\Model;

use App\Middleware\MiddlewareInterface;

class AuthCheckMiddleware implements MiddlewareInterface
{
    protected AuthCheckMiddleware $next;

    public function getNext()
    {
        return $this->next;
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

        if ($isGuessPage) {
            return $route;
        } else {
            throw new HttpRedirectException('/login');
        }
    }
}
