<?php

declare(strict_types=1);

namespace App\Api;

use App\Model\SessionHandle;

interface HandleInterface
{
    public function setNext(SessionHandle $handle);

    public function getNext();

    public function isGuestPages(string $url);
}
