<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\AbstractController;
use App\Model\Session;
use App\Ui\ControllerInterface;

abstract class AbstractWebController extends AbstractController implements ControllerInterface
{
    public function __construct()
    {
        Session::start();
    }

    abstract public function execute();
}
