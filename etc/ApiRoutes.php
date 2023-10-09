<?php

use App\Controller\Api\PlayerController;
use App\Controller\Api\GameController;
use App\Controller\Api\CompanyController;
use App\Controller\Api\UpdatePlayerController;
use App\Controller\Api\UpdateGameController;
use App\Controller\Api\UpdateCompanyController;
use App\Controller\Api\DeletePlayerController;
use App\Controller\Api\DeleteGameController;
use App\Controller\Api\DeleteCompanyController;
use App\Controller\Api\AddPlayerController;
use App\Controller\Api\AddGameController;
use App\Controller\Api\AddCompanyController;
use App\Controller\Api\MainController;
use App\Controller\Api\ShopController;

return [
    '/player'         => PlayerController::class,
    '/game'           => GameController::class,
    '/company'        => CompanyController::class,
    '/update-player'  => UpdatePlayerController::class,
    '/update-game'    => UpdateGameController::class,
    '/update-company' => UpdateCompanyController::class,
    '/delete-player'  => DeletePlayerController::class,
    '/delete-game'    => DeleteGameController::class,
    '/delete-company' => DeleteCompanyController::class,
    '/add-player'     => AddPlayerController::class,
    '/add-game'       => AddGameController::class,
    '/add-company'    => AddCompanyController::class,
    '/main'           => MainController::class,
    '/shop'           => ShopController::class,
];
