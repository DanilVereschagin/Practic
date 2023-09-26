<?php

namespace App\Model;

class SessionObserver
{
    protected array $guessPages = [];

    public function __construct()
    {
        $this->guessPages[] = '/login';
        $this->guessPages[] = '/registration';
        $this->guessPages[] = '/add-player';
        $this->guessPages[] = '/sign-in';
    }

    public function getGuestPages(string $url)
    {
        foreach ($this->guessPages as $page) {
            if ($page === $url) {
                return $page;
            }
        }

        return $this->guessPages[0];
    }
}
