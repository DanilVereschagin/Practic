<?php

declare(strict_types=1);

namespace App\Controller\Service;

use App\Block\MailingBlock;
use App\Controller\AbstractController;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\SendinBlueApiService;

class MailingController extends AbstractController
{
    public function execute()
    {
        $resource = new PlayerResource();
        $players = $resource->getAllPlayers();

        foreach ($players as $player) {
            $to[] = ['name' => $player->getName(), 'email' => $player->getMail()];
        }
        $to[] = ['name' => 'dvereschagin', 'email' => 'dvereschagin@lachestry.com'];

        $subject = 'Have you forgotten about us?';
        $htmlContent = file_get_contents(APP_ROOT . '/view/emailTemplate/email.phtml');
        $sendSmtpEmails = SendinBlueApiService::getSmtpEmails($subject, $htmlContent, $to);

        SendinBlueApiService::sendSmtpEmails($sendSmtpEmails);

        $block = new MailingBlock();
        $block->render();
    }
}
