<?php

declare(strict_types=1);

namespace App\Block;

class EmailBlock extends AbstractBlock
{
    protected $renderedTemplate;
    public function renderTemplate()
    {
        ob_start();
        require APP_ROOT . '/view/emailTemplate/email.phtml';
        $this->renderedTemplate = ob_get_contents();
        ob_end_clean();
    }

    public function getRenderedTemplate()
    {
        return $this->renderedTemplate;
    }
}
