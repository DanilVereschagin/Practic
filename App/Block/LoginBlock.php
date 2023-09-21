<?php

declare(strict_types=1);

namespace App\Block;

class LoginBlock extends AbstractGuestBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/login.phtml';
    }
}
