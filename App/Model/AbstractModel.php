<?php

declare(strict_types=1);

namespace App\Model;

class AbstractModel
{
    protected function setData(?array $data = [])
    {
        foreach (array_keys($data) as $datum) {
            $partsOfSet = explode('_', $datum);
            $set = "";
            foreach ($partsOfSet as $part) {
                $set = $set . ucfirst($part);
            }
            $set = 'set' . $set;
            $this->{$set}($data[$datum]);
        }
    }
}
