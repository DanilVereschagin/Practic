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
use App\Controller\AdminController;
use App\Controller\AdminPlayersController;
use App\Controller\AdminGamesController;
use App\Controller\CompaniesController;
use App\Controller\AdminGameController;
use App\Controller\EditGameController;
use App\Controller\UpdateGameController;
use App\Controller\EditCompanyController;
use App\Controller\UpdateCompanyController;
use App\Controller\EditPlayerController;
use App\Controller\UpdatePlayerController;
use App\Controller\AddCommentController;
use App\Controller\DeleteCompanyController;
use App\Controller\DeleteGameController;
use App\Controller\DeletePlayerController;
use App\Controller\LoginController;
use App\Controller\RegistrationController;
use App\Controller\AddPlayerController;
use App\Controller\SignInController;
use App\Controller\LogoutController;
use App\Controller\ErrorController;

return [
    '/'               => MainController::class,
    '/main'           => MainController::class,
    '/player'         => PlayerController::class,
    '/game'           => GameController::class,
    '/shop'           => ShopController::class,
    '/library'        => LibraryController::class,
    '/addgame'        => AddGameController::class,
    '/newgame'        => NewGameController::class,
    '/newcompany'     => NewCompanyController::class,
    '/addcompany'     => AddCompanyController::class,
    '/admin'          => AdminController::class,
    '/admin-players'  => AdminPlayersController::class,
    '/admin-games'    => AdminGamesController::class,
    '/companies'      => CompaniesController::class,
    '/admin-game'     => AdminGameController::class,
    '/edit-game'      => EditGameController::class,
    '/update-game'    => UpdateGameController::class,
    '/edit-company'   => EditCompanyController::class,
    '/update-company' => UpdateCompanyController::class,
    '/edit-player'    => EditPlayerController::class,
    '/update-player'  => UpdatePlayerController::class,
    '/add-comment'    => AddCommentController::class,
    '/delete-company' => DeleteCompanyController::class,
    '/delete-game'    => DeleteGameController::class,
    '/delete-player'  => DeletePlayerController::class,
    '/login'          => LoginController::class,
    '/registration'   => RegistrationController::class,
    '/add-player'     => AddPlayerController::class,
    '/sign-in'        => SignInController::class,
    '/logout'         => LogoutController::class,
    '/error'          => ErrorController::class,
];
