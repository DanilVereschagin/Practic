<?php

declare(strict_types=1);

use App\ConsoleCommand\ExportGameInfo;
use App\ConsoleCommand\Notification;

return [
    'game:export'       => ExportGameInfo::class,
    'notification:send' => Notification::class,
];
