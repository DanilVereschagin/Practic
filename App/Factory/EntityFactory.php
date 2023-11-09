<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

class EntityFactory
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function create(string $entity = 'abstractModel', array $params = [])
    {
        $instance = 'App\\Model\\' . ucfirst($entity);
        return $this->di->get($instance, $params);
    }
}
