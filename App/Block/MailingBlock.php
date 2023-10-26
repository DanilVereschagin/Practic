<?php

declare(strict_types=1);

namespace App\Block;

class MailingBlock extends AbstractAdminBlock
{
    public function renderTemplate()
    {
        require APP_ROOT . '/view/template/mailing.phtml';
    }
}
