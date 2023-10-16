<?php

namespace App\Factory;

use App\Model\FileHandler\FileHandlerCsv;
use App\Model\FileHandler\FileHandlerXls;

class FileHandlerFactory
{
    public function create(string $format)
    {
        switch ($format) {
            case 'xls':
                return new FileHandlerXls();
            default:
                return new FileHandlerCsv();
        }
    }
}