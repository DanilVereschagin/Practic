<?php

declare(strict_types=1);

namespace App\Controller\Service;

use App\Block\MailingBlock;
use App\Controller\AbstractController;
use App\Factory\BlockFactory;
use App\Factory\ServiceFactory;
use App\Model\Service\EmailService;
use Laminas\Di\Di;

class MailingController extends AbstractController
{
    protected $blockFactory;
    protected $serviceFactory;

    public function __construct(Di $di, ServiceFactory $serviceFactory, BlockFactory $blockFactory)
    {
        parent::__construct($di);
        $this->blockFactory = $blockFactory;
        $this->serviceFactory = $serviceFactory;
        $this->di = $di;
    }

    public function execute()
    {
        $subject = 'Have you forgotten about us?';

        $service = $this->serviceFactory->create('email', ['di' => $this->di]);
        $service->sendMailing($subject);

        $block = $this->blockFactory->create('mailing', ['di' => $this->di]);
        $block->render();
    }
}
