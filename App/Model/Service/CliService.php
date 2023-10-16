<?php

declare(strict_types=1);

namespace App\Model\Service;

define('CLI_ROOT', __DIR__ . '/../../..');
require CLI_ROOT . '/vendor/autoload.php';

class CliService
{
    protected string $fileType;

    public function __construct()
    {
        $this->fileType = getopt('filetype:') ?: 'csv';
        $this->scriptRouter();
    }

    protected function scriptRouter()
    {
        $scriptMap = require CLI_ROOT . '/etc/ScriptRoutes.php';

        $argument = $_SERVER['argv'][1];
        $class = $scriptMap[$argument] ?? null;

        $script = new $class($this->fileType);
    }
}

$class = new CliService();
