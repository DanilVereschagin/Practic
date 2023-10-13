<?php

namespace App\Script;

define('SCRIPT_ROOT', __DIR__ . '/../..');
require SCRIPT_ROOT . '/vendor/autoload.php';

use App\Model\Database;
use App\Model\Environment;
use App\Model\Resource\GameResource;

class GetComplexGameInfo
{
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
            $gamesComplexInfo[] = $resource->getComplexInfoById($game->getId());
        }

        $this->writeToFile($gamesComplexInfo);
    }

    protected function writeToFile(array $dataset)
    {
        $path = SCRIPT_ROOT .  '/var/output/games_complex_info_' . date('Y-m-d_h:i:s') . '.csv';
        $file = fopen($path, 'w');
        foreach ($dataset as $data) {
            $companyData = (array)$data->getCompanyObject();
            $genreData = (array)$data->getGenreObject();
            $data = (array)$data;
            array_pop($data);
            array_pop($data);
            $data = array_merge($data, $companyData, $genreData);
            fputcsv($file, $data);
        }
        fclose($file);
    }
}

$class = new GetComplexGameInfo();
