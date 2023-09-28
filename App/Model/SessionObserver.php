<?php

namespace App\Model;

class SessionObserver
{
    protected array $guessPages = [];

    public function __construct()
    {
        $this->guessPages = [
            '/login',
            '/registration',
            '/add-player',
            '/sign-in',
        ];
    }

    public function isGuestPages(string $url)
    {
        foreach ($this->guessPages as $page) {
            if ($page === $url) {
                return true;
            }
        }

        return false;
    }
}
