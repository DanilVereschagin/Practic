<?php

use App\Controller\GameController;
use App\Controller\LibraryController;
use App\Controller\PlayerController;
use App\Controller\ShopController;
use App\Controller\AddGameController;
use App\Controller\NewGameController;
use App\Controller\NewCompanyController;
use App\Controller\AddCompanyController;
use App\Controller\MainController;

return [
    '/' => MainController::class,
    '/main' => MainController::class,
    '/player' => PlayerController::class,
    '/game' => GameController::class,
    '/shop' => ShopController::class,
    '/library' => LibraryController::class,
    '/addgame' => AddGameController::class,
    '/newgame' => NewGameController::class,
    '/newcompany' => NewCompanyController::class,
    '/addcompany' => AddCompanyController::class,
];
