<?php

declare(strict_types=1);

namespace App\Model\Resource;

class EnvironmentResource
{
    public function parseEnvFile(string $path)
    {
        $rowset = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $parsedRowset = [];
        $section = '';
        foreach ($rowset as $row) {
            $isGroupRow = mb_substr($row, 0, 1) == '[';
            if ($isGroupRow) {
                $section = mb_substr($row, 1, strlen($row) - 2);
                $parsedRowset[$section] = [];
            } else {
                $setting = explode('=', $row);
                $name = trim($setting[0]);
                $value = trim($setting[1], ' "\'');

                $parsedRowset[$section][$name] = $value;
            }
        }

        return $parsedRowset;
    }
}
