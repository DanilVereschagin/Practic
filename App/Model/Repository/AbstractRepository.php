<?php

declare(strict_types=1);

namespace App\Model\Repository;

use Laminas\Di\Di;

class AbstractRepository
{
    protected Di $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }
}
