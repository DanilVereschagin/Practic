<?php

declare(strict_types=1);

namespace App\Factory;

class BlockFactory extends AbstractFactory
{
    public function create(string $block = 'abstract', array $params = [])
    {
        $instance = 'App\\Block\\' . ucfirst($block) . 'Block';
        return $this->di->newInstance($instance, $params);
    }
}
