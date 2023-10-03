<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Web\AbstractController;
use App\Ui\ControllerInterface;

abstract class AbstractApiController extends AbstractController implements ControllerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isPut(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }
}
