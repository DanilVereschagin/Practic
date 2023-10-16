<?php

declare(strict_types=1);

namespace App\Model\FileHandler;

class FileHandlerCsv implements FileHandlerInterface
{
    public function writeToFile(array $dataset)
    {
        $path = APP_ROOT .  '/var/output/games_complex_info_' . date('Y-m-d_h:i:s') . '.csv';
        $file = fopen($path, 'w');
        foreach ($dataset as $data) {
            fputcsv($file, $data);
        }
        fclose($file);
    }
}
