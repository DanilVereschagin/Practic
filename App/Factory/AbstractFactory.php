<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

abstract class AbstractFactory
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    abstract public function create(string $abstract = 'abstract', array $params = []);
}
