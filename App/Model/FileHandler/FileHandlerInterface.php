<?php

namespace App\Model\FileHandler;

interface FileHandlerInterface
{
    public function writeToFile(array $dataset);
}
