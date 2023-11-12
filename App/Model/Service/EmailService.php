<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Block\EmailBlock;
use App\Factory\BlockFactory;
use App\Factory\ResourceFactory;
use App\Model\Resource\PlayerResource;
use App\Model\Service\WebApiSevice\SendinBlueApiService;
use Laminas\Di\Di;

class EmailService extends AbstractService
{
    protected $resourceFactory;
    protected $blockFactory;
    protected $sendSmtpEmail;

    public function __construct(
        Di $di,
        ResourceFactory $resourceFactory,
        BlockFactory $blockFactory,
        SendinBlueApiService $apiService
    ) {
        parent::__construct($di);
        $this->resourceFactory = $resourceFactory;
        $this->blockFactory = $blockFactory;
        $this->sendSmtpEmail = $apiService;
    }

    public function sendMailing(string $subject, ?string $email = '')
    {
        if ($email) {
            $emails = $this->prepareLetter($subject, $email);
        } else {
            $emails = $this->prepareMailing($subject);
        }

        $this->sendSmtpEmail->sendSmtpEmails($emails);
    }

    protected function prepareLetter(string $subject, string $email)
    {
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $player = $resource->getByMail($email);

        $name = $player->getName();

        if (!$name) {
            $name = 'Товарищ';
        }

        $to[] = ['name' => $name, 'email' => $email];
        $htmlContent = $this->getHtmlContent();

        return $this->sendSmtpEmail->getSmtpEmails($subject, $htmlContent, $to);
    }

    protected function prepareMailing(string $subject)
    {
        $resource = $this->resourceFactory->create('player', ['di' => $this->di]);
        $players = $resource->getAllPlayers();

        foreach ($players as $player) {
            $to[] = ['name' => $player->getName(), 'email' => $player->getMail()];
        }
        $to[] = ['name' => 'dvereschagin', 'email' => 'dvereschagin@lachestry.com'];

        $htmlContent = $this->getHtmlContent();
        return $this->sendSmtpEmail->getSmtpEmails($subject, $htmlContent, $to);
    }

    protected function getHtmlContent()
    {
        $block = $this->blockFactory->create('email');
        return $block->getRenderedTemplate();
    }
}
