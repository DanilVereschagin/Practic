<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\PasswordService;

class PlayerRepository
{
    public function setDefaultValues(array $data): array
    {
        $data['date_of_registration'] = date('Y-m-d h:i:s');
        $data['is_admin'] = 0;
        $data['fake_hour'] = 0;
        $password = new PasswordService();
        $data['password'] = $password->hashPassword($data['password']);
        return $data;
    }
}
