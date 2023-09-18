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
            if (mb_substr($row, 0, 1) == '[') {
                $section = mb_substr($row, 1, strlen($row) - 2);
                $parsedRowset[$section] = [];
            } else {
                $separatorPlace = mb_stripos($row, '=');
                $name = mb_substr($row, 0, $separatorPlace - 1);
                $value = mb_substr($row, $separatorPlace + 3, strlen($row) - strlen($name) - 5);
                $parsedRowset[$section][$name] = $value;
            }
        }

        return $parsedRowset;
    }
}
