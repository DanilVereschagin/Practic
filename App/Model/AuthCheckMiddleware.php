<?php

declare(strict_types=1);

namespace App\Model;

class AuthCheckMiddleware
{
    public function checkAuth(string $route)
    {
        Session::start();

        if (Session::getClientId() !== null) {
            return $route;
        }

        $observer = new SessionObserver();
        $isGuessPage = $observer->isGuestPages($route);

        if ($isGuessPage) {
            return $route;
        } else {
            throw new HttpRedirectException('/login');
        }
    }
}
