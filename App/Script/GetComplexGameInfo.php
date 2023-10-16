<?php

namespace App\Script;

define('SCRIPT_ROOT', __DIR__ . '/../..');
require SCRIPT_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\Environment;
use App\Model\Resource\GameResource;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GetComplexGameInfo
{
    protected string $fileFormat = 'csv';
    public function __construct()
    {
        Environment::getInstance(SCRIPT_ROOT);
        Database::getInstance();
        $this->getInfo();
    }
    public function getInfo()
    {
        $resource = new GameResource();
        $games = $resource->getAll();
        $gamesComplexInfo = [];

        foreach ($games as $game) {
            $complexInfo = $resource->getComplexInfoById($game->getId());
            $companyData = (array)$complexInfo->getCompanyObject();
            $genreData = (array)$complexInfo->getGenreObject();
            $complexInfo = (array)$complexInfo;
            array_pop($complexInfo);
            array_pop($complexInfo);
            $complexInfo = array_merge($complexInfo, $companyData, $genreData);
            $gamesComplexInfo[] = $complexInfo;
        }

        switch ($this->fileFormat) {
            case 'csv':
                $this->writeToCsv($gamesComplexInfo);
                break;
            case 'xls':
                $this->writeToExcel($gamesComplexInfo);
                break;
        }
    }

    protected function writeToCsv(array $dataset)
    {
        $path = SCRIPT_ROOT .  '/var/output/games_complex_info_' . date('Y-m-d_h:i:s') . '.csv';
        $file = fopen($path, 'w');
        foreach ($dataset as $data) {
            fputcsv($file, $data);
        }
        fclose($file);
    }

    protected function writeToExcel(array $dataset)
    {
        $path = SCRIPT_ROOT .  '/var/output/games_complex_info_' . date('Y-m-d_h:i:s') . '.xls';
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->fromArray($dataset, null);

        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }
}

$class = new GetComplexGameInfo();
