<?php

declare(strict_types=1);

namespace App\Model;

use App\Api\HandleInterface;

class AuthCheckMiddleware
{
    public function handle(string $route)
    {
        Session::start();

        if (Session::getClientId() !== null) {
            return $route;
        }

        $observer = new SessionHandle(0);
        $observer->setNext(new SessionHandle(1));
        $observer->getNext()->setNext(new SessionHandle(2));
        $observer->getNext()->getNext()->setNext(new SessionHandle(3));
        $isGuessPage = $observer->isGuestPages($route);

        if ($isGuessPage) {
            return $route;
        } else {
            throw new HttpRedirectException('/login');
        }
    }
}
