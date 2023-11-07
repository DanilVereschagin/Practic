<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\AbstractController;
use App\Model\Session;
use App\Ui\ControllerInterface;
use Laminas\Di\Di;

abstract class AbstractWebController extends AbstractController implements ControllerInterface
{
    public function __construct(Di $di)
    {
        parent::__construct($di);
        Session::start();
    }

    abstract public function execute();
}
