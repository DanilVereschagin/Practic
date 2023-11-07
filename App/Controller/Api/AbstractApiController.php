<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Ui\ControllerInterface;
use Laminas\Di\Di;

abstract class AbstractApiController extends AbstractController implements ControllerInterface
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        $this->di = $di;
    }
}
