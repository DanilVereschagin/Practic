<?php

declare(strict_types=1);

namespace App\ConsoleCommand;

use App\Model\Service\EmailService;

class Notification
{
    protected ?string $email;
    public function __construct()
    {
        $this->email = $_SERVER['argv'][2] ?? null;
        $this->sendMail();
    }

    public function sendMail()
    {
        if ($this->email === null) {
            return;
        }

        $this->email = mb_substr($this->email, 8);

        $subject = 'Have you forgotten about us?';

        $service = new EmailService();
        $service->sendMailing($subject, $this->email);
    }
}
