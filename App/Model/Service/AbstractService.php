<?php

declare(strict_types=1);

namespace App\Model\Service;

use Laminas\Di\Di;

class AbstractService
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }
}
