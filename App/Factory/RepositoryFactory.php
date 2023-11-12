<?php

declare(strict_types=1);

namespace App\Factory;

class RepositoryFactory extends AbstractFactory
{
    public function create(string $repository = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Repository\\' . ucfirst($repository) . 'Repository';
        return $this->di->newInstance($instance, $params);
    }
}
