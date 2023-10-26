<?php

declare(strict_types=1);

namespace App\ConsoleCommand;

use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\SendinBlueApiService;

class Notification
{
    protected ?string $email;
    public function __construct()
    {
        $this->email = $_SERVER['argv'][2] ?: null;
        $this->sendMail();
    }

    public function sendMail()
    {
        if ($this->email === null) {
            return;
        }

        $this->email = mb_substr($this->email, 8);

        $resource = new PlayerResource();
        $player = $resource->getByMail($this->email);

        $name = $player->getName();

        if (!$name) {
            $name = 'Товарищ';
        }

        $to = ['name' => $name, 'email' => $this->email];
        $subject = 'Have you forgotten about us?';
        $htmlContent = file_get_contents(APP_ROOT . '/view/emailTemplate/email.phtml');

        $sendSmtpEmails = SendinBlueApiService::getSmtpEmail($subject, $htmlContent, $to);
        SendinBlueApiService::sendSmtpEmail($sendSmtpEmails);
    }
}
