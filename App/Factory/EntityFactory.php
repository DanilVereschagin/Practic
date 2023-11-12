<?php

declare(strict_types=1);

namespace App\Factory;

class EntityFactory extends AbstractFactory
{
    public function create(string $entity = 'abstractModel', array $params = [])
    {
        $instance = 'App\\Model\\' . ucfirst($entity);
        return $this->di->newInstance($instance, $params);
    }
}
