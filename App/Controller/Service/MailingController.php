<?php

declare(strict_types=1);

namespace App\Controller\Service;

use App\Controller\AbstractController;
use App\Model\Service\WebApiSevice\SendinBlueApiService;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;

class MailingController extends AbstractController
{
    public function execute()
    {
        $apiInstance = SendinBlueApiService::getInstance();

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Have you forgotten about us?';
        $sendSmtpEmail['htmlContent'] = '<html><body><h1>This is a transactional email </h1></body></html>';
        $sendSmtpEmail['sender'] = ['name' => 'Orion Games', 'email' => 'orion.games@gmail.com'];
        $sendSmtpEmail['to'] = [
            ['email' => 'dvereschagin@lachestry.com', 'name' => 'dvereschagin']
        ];

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
