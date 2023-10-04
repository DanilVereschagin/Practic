<?php

declare(strict_types=1);

namespace App\Model;

class PasswordService
{
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $firstPassword, string $secondPassword)
    {
        return password_verify($firstPassword, $secondPassword);
    }
}