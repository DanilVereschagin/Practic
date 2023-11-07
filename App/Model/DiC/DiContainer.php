<?php

declare(strict_types=1);

namespace App\Model\DiC;

use Laminas\Di\Di;

class DiContainer
{
    protected $di;
    protected $instanceManager;

    public function __construct(Di $di)
    {
        $this->di = $di;
        $this->instanceManager = $di->instanceManager();
    }

    public function assemble()
    {
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if (strpos($method->getName(), 'assemble') == 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }

    protected function assembleAlias()
    {
        /** @var DiAlias $diAlias */
        $diAlias = $this->di->get(DiAlias::class, ['di' => $this->di]);
        $diAlias->assemble();
    }

    protected function assembleRouters()
    {
        /** @var DiRouters $diRouters */
        $diRouters = $this->di->get(DiRouters::class, ['di' => $this->di]);
        $diRouters->assemble();
    }

    protected function assembleCaches()
    {
        /** @var DiCaches $diCaches */
        $diCaches = $this->di->get(DiCaches::class, ['di' => $this->di]);
        $diCaches->assemble();
    }
}
