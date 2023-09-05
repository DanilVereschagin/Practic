<?php

use App\Controller\GameController;
use App\Controller\IndexController;
use App\Controller\LibraryController;
use App\Controller\PlayerController;
use App\Controller\ShopController;

return [
    '/' => IndexController::class,
    '/player' => PlayerController::class,
    '/game' => GameController::class,
    '/shop' => ShopController::class,
    '/library' => LibraryController::class,
];
