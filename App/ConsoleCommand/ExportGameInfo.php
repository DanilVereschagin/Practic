<?php

namespace App\ConsoleCommand;

use App\Factory\FileHandlerFactory;
use App\Factory\ResourceFactory;
use App\Model\Resource\GameResource;
use Laminas\Di\Di;

class ExportGameInfo
{
    protected string $fileFormat;
    protected $resourceFactory;
    protected $fileHandlerFactory;
    protected $di;

    public function __construct(ResourceFactory $resourceFactory, Di $di, FileHandlerFactory $fileFactory)
    {
        $this->resourceFactory = $resourceFactory;
        $this->fileHandlerFactory = $fileFactory;
        $this->di = $di;
        $this->fileFormat = getopt('filetype:') ?: 'csv';
        $this->getInfo();
    }
    public function getInfo()
    {
        $resource = $this->resourceFactory->create('game', ['di' => $this->di]);
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

        $fileHandler = $this->fileHandlerFactory->create($this->fileFormat);
        $fileHandler->writeToFile($gamesComplexInfo);
    }
}
