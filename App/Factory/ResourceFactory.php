<?php

declare(strict_types=1);

namespace App\Factory;

class ResourceFactory extends AbstractFactory
{
    public function create(string $resource = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Resource\\' . ucfirst($resource) . 'Resource';
        return $this->di->newInstance($instance, $params);
    }
}
