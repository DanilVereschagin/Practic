<?php

namespace App\ConsoleCommand;

use App\Factory\FileHandlerFactory;
use App\Model\Resource\GameResource;

class ExportGameInfo
{
    protected string $fileFormat;
    public function __construct()
    {
        $this->fileFormat = getopt('filetype:') ?: 'csv';
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

        $fileHandlerFactory = new FileHandlerFactory();
        $fileHandler = $fileHandlerFactory->create($this->fileFormat);
        $fileHandler->writeToFile($gamesComplexInfo);
    }
}
