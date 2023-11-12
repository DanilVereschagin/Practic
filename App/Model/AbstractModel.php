<?php

declare(strict_types=1);

namespace App\Model;

use Laminas\Di\Di;

class AbstractModel
{
    protected Di $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    protected function setData(?array $data = [])
    {
        foreach ($data as $datum => $value) {
            $partsOfField = explode('_', $datum);
            $method = 'set';
            foreach ($partsOfField as $part) {
                $method = $method . ucfirst($part);
            }
            $this->{$method}($value);
        }
    }
}
