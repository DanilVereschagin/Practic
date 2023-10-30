<?php

declare(strict_types=1);

namespace App\Controller\Service;

use App\Block\MailingBlock;
use App\Controller\AbstractController;
use App\Model\Service\EmailService;

class MailingController extends AbstractController
{
    public function execute()
    {
        $subject = 'Have you forgotten about us?';

        $service = new EmailService();
        $service->sendMailing($subject);

        $block = new MailingBlock();
        $block->render();
    }
}
