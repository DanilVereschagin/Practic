<?php

declare(strict_types=1);

namespace App\Model;

class AbstractModel
{
    protected function setData(?array $data = [])
    {
        foreach ($data as $datum => $value) {
            $partsOfField = explode("_", $datum);
            $method = "set";
            foreach ($partsOfField as $part) {
                $method = $method . ucfirst($part);
            }
            $this->{$method}($value);
        }
    }
}
