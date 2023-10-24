<?php

use App\Controller\Web\AddCommentController;
use App\Controller\Web\AddCompanyController;
use App\Controller\Web\AddGameController;
use App\Controller\Web\AddPlayerController;
use App\Controller\Web\AdminController;
use App\Controller\Web\AdminGameController;
use App\Controller\Web\AdminGamesController;
use App\Controller\Web\AdminPlayersController;
use App\Controller\Web\CompaniesController;
use App\Controller\Web\DeleteCompanyController;
use App\Controller\Web\DeleteGameController;
use App\Controller\Web\DeletePlayerController;
use App\Controller\Web\EditCompanyController;
use App\Controller\Web\EditGameController;
use App\Controller\Web\EditPlayerController;
use App\Controller\Web\ErrorController;
use App\Controller\Web\GameController;
use App\Controller\Web\LibraryController;
use App\Controller\Web\LoginController;
use App\Controller\Web\LogoutController;
use App\Controller\Web\MainController;
use App\Controller\Web\NewCompanyController;
use App\Controller\Web\NewGameController;
use App\Controller\Web\PlayerController;
use App\Controller\Web\RegistrationController;
use App\Controller\Web\ShopController;
use App\Controller\Web\SignInController;
use App\Controller\Web\SteamApiController;
use App\Controller\Web\UpdateCompanyController;
use App\Controller\Web\UpdateGameController;
use App\Controller\Web\UpdatePlayerController;
use App\Controller\Service\MailingController;

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
    '/steam-api'      => SteamApiController::class,
    '/mailing'        => MailingController::class,
];
