<?php

declare(strict_types=1);

namespace App\Block;

class RegistrationBlock extends AbstractGuestBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/registration.phtml';
    }
}
