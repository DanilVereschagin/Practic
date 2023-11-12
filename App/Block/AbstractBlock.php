<?php

namespace App\Block;

use App\Model\Session;
use Laminas\Di\Di;

class AbstractBlock
{
    protected $template;
    protected $renderedTemplate;
    protected Di $di;
    protected $session;

    public function __construct(Di $di, Session $session)
    {
        $this->di = $di;
        $this->session = $session;
    }

    public function render()
    {
        require_once APP_ROOT . '/view/layout/player-layout.phtml';
    }

    public function getRenderedTemplate()
    {
        ob_start();
        require APP_ROOT . '/view' . $this->template;
        $this->renderedTemplate = ob_get_contents();
        ob_end_clean();

        return $this->renderedTemplate;
    }

    public function getCsrfToken()
    {
        return $this->session->getCsrfToken();
    }

    public function protectFromXss($data): string
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
