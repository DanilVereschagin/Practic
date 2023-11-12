<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use App\Model\Environment;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;

class SendinBlueApiService
{
    protected $apiInstance = null;
    protected $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;

        $config = Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            $environment->getMailSetting('SENDINBLUE')
        );

        $this->apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
    }

    public function getSmtpEmail(string $subject, string $htmlContent, array $to)
    {
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = $subject;
        $sendSmtpEmail['htmlContent'] = $htmlContent;
        $sendSmtpEmail['sender'] = [
            'name' => $this->environment->getMailSetting('NAME'),
            'email' => $this->environment->getMailSetting('EMAIL')
        ];
        $sendSmtpEmail['to'] = [$to];

        return $sendSmtpEmail;
    }

    public function getSmtpEmails(string $subject, string $htmlContent, array $to)
    {
        $sendSmtpEmails = [];
        foreach ($to as $player) {
            $html = str_replace('Товарищ', $player['name'], $htmlContent);
            $sendSmtpEmails[] = $this->getSmtpEmail($subject, $html, $player);
        }

        return $sendSmtpEmails;
    }

    public function sendSmtpEmail(SendSmtpEmail $email)
    {
        try {
            $result = $this->apiInstance->sendTransacEmail($email);
        } catch (\Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function sendSmtpEmails(array $emails)
    {
        foreach ($emails as $email) {
            $this->sendSmtpEmail($email);
        }
    }
}
