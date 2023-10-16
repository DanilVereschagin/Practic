<?php

declare(strict_types=1);

namespace App\Model\FileHandler;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileHandlerXls implements FileHandlerInterface
{
    public function writeToFile(array $dataset)
    {
        $path = APP_ROOT .  '/var/output/games_complex_info_' . date('Y-m-d_h:i:s') . '.xls';
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->fromArray($dataset, null);

        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }
}
