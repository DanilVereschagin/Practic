<?php

namespace App\Model;

use App\Api\HandleInterface;

class SessionHandle implements HandleInterface
{
    protected array $guessPages = [];
    protected string $page;
    protected SessionHandle $next;

    public function __construct(int $number)
    {
        $this->guessPages = [
            '/login',
            '/registration',
            '/add-player',
            '/sign-in',
        ];
        $this->page = $this->guessPages[$number];
    }

    public function setNext(SessionHandle $handle)
    {
        $this->next = $handle;
    }

    public function getNext()
    {
        return $this->next ?? null;
    }

    public function isGuestPages(string $url)
    {
        if ($url === $url) {
            return true;
        }

        if ($this->next !== null) {
            $this->next->isGuestPages($url);
        }

        return false;
    }
}
