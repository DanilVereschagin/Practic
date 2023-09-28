<?php

declare(strict_types=1);

namespace App\Block;

class ErrorBlock
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function render()
    {
        require APP_ROOT . '/view/template/error.phtml';
    }

    public function protectFromXss($data): string
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
