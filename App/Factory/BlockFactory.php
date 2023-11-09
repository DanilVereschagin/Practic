<?php

declare(strict_types=1);

namespace App\Factory;

use Laminas\Di\Di;

class BlockFactory
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function create(string $block = 'abstract', array $params = [])
    {
        $instance = 'App\\Block\\' . ucfirst($block) . 'Block';
        return $this->di->get($instance, $params);
    }
}
