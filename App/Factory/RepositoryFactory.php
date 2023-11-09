<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

class RepositoryFactory
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function create(string $repository = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Repository\\' . ucfirst($repository) . 'Repository';
        return $this->di->get($instance, $params);
    }
}
