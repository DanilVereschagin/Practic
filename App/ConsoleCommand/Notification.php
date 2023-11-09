<?php

declare(strict_types=1);

namespace App\ConsoleCommand;

use App\Factory\ServiceFactory;
use App\Model\Service\EmailService;
use Laminas\Di\Di;

class Notification
{
    protected ?string $email;
    protected $serviceFactory;
    protected $di;
    public function __construct(Di $di, ServiceFactory $serviceFactory)
    {
        $this->di = $di;
        $this->serviceFactory = $serviceFactory;
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

        $service = $this->serviceFactory->create('email', ['di' => $this->di]);
        $service->sendMailing($subject, $this->email);
    }
}
