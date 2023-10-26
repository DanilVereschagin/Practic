<?php

declare(strict_types=1);

namespace App\Model\Service\WebApiSevice;

use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;

class SendinBlueApiService
{
    protected static $apiInstance = null;

    protected function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            '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'
        );

        self::$apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
    }

    public static function getInstance()
    {
        if (self::$apiInstance === null) {
            new self();
        }

        return self::$apiInstance;
    }

    public static function getSmtpEmail(string $subject, string $htmlContent, array $to)
    {
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = $subject;
        $sendSmtpEmail['htmlContent'] = $htmlContent;
        $sendSmtpEmail['sender'] = ['name' => 'Orion Games', 'email' => 'orion.games@gmail.com'];
        $sendSmtpEmail['to'] = [$to];

        return $sendSmtpEmail;
    }

    public static function getSmtpEmails(string $subject, string $htmlContent, array $to)
    {
        $sendSmtpEmails = [];
        foreach ($to as $player) {
            $html = str_replace('Товарищ', $player['name'], $htmlContent);
            $sendSmtpEmails[] = self::getSmtpEmail($subject, $html, $player);
        }

        return $sendSmtpEmails;
    }

    public static function sendSmtpEmail(SendSmtpEmail $email)
    {
        try {
            $result = self::$apiInstance->sendTransacEmail($email);
        } catch (\Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    public static function sendSmtpEmails(array $emails)
    {
        foreach ($emails as $email) {
            self::sendSmtpEmail($email);
        }
    }
}
