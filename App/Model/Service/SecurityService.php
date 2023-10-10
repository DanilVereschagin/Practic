<?php

declare(strict_types=1);

namespace App\Model\Service;

class SecurityService
{
    public function generateCsrf()
    {
        return bin2hex(random_bytes(32));
    }
}