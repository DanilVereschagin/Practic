<?php

namespace App\Factory;

use App\Model\FileHandler\FileHandlerCsv;
use App\Model\FileHandler\FileHandlerXls;
use Laminas\Di\Di;

class FileHandlerFactory
{
    protected $csv;
    protected $xls;

    public function __construct(FileHandlerCsv $csv, FileHandlerXls $xls)
    {
        $this->csv = $csv;
        $this->xls = $xls;
    }

    public function create(string $format)
    {
        switch ($format) {
            case 'xls':
                return $this->xls;
            default:
                return $this->csv;
        }
    }
}