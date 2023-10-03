<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Model\HttpMethodNotAllowedException;
use App\Model\HttpRedirectException;
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
