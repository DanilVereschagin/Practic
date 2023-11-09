<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

class ResourceFactory
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function create(string $resource = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Resource\\' . ucfirst($resource) . 'Resource';
        return $this->di->get($instance, $params);
    }
}
