<?php

use App\Controller\Api\PlayerController;
use App\Controller\Api\GameController;
use App\Controller\Api\CompanyController;
use App\Controller\Api\UpdatePlayerController;

return [
    '/player'        => PlayerController::class,
    '/game'          => GameController::class,
    '/company'       => CompanyController::class,
    '/update-player' => UpdatePlayerController::class,
];
