<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Block\EmailBlock;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\SendinBlueApiService;

class EmailService
{
    public function sendMailing(string $subject, ?string $email = '')
    {
        if ($email) {
            $emails = $this->prepareLetter($subject, $email);
        } else {
            $emails = $this->prepareMailing($subject);
        }

        SendinBlueApiService::sendSmtpEmails($emails);
    }

    protected function prepareLetter(string $subject, string $email)
    {
        $resource = new PlayerResource();
        $player = $resource->getByMail($email);

        $name = $player->getName();

        if (!$name) {
            $name = 'Товарищ';
        }

        $to[] = ['name' => $name, 'email' => $email];
        $htmlContent = $this->getHtmlContent();

        return SendinBlueApiService::getSmtpEmails($subject, $htmlContent, $to);
    }

    protected function prepareMailing(string $subject)
    {
        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        foreach ($players as $player) {
            $to[] = ['name' => $player->getName(), 'email' => $player->getMail()];
        }
        $to[] = ['name' => 'dvereschagin', 'email' => 'dvereschagin@lachestry.com'];

        $htmlContent = $this->getHtmlContent();
        return SendinBlueApiService::getSmtpEmails($subject, $htmlContent, $to);
    }

    protected function getHtmlContent()
    {
        $block = new EmailBlock();
        return $block->getRenderedTemplate();
    }
}
