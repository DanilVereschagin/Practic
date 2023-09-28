<?php

declare(strict_types=1);

namespace App\Model;

class SecurityService
{
    public function generateCsrf()
    {
        return bin2hex(random_bytes(32));
    }
}