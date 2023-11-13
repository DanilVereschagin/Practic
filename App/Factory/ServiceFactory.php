<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

class ServiceFactory extends AbstractFactory
{
    public function create(string $service = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Service\\' . ucfirst($service) . 'Service';
        return $this->di->newInstance($instance, $params);
    }

    public function createWebApi(string $service = 'abstract', array $params = [])
    {
        $instance = 'App\\Model\\Service\\WebApiSevice\\' . ucfirst($service) . 'Service';
        return $this->di->newInstance($instance, $params);
    }
}
