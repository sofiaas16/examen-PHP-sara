<?php

use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;
use Slim\App;

use function DI\get;

return function (App $app) {
    $app->group('/register', function ($group) {
        $group->get('', [UserController::class, 'index']);
        $group->get('/{id}', [UserController::class, 'show']);
        $group->put('/{id}', [UserController::class, 'update']);
        $group->delete('/{id}', [UserController::class, 'destroy']);
        $group->post('/user', [UserController::class, 'createUser']);
        $group->post('/admin', [UserController::class, 'createAdmin']);
    });

    $app->group('/login', function ($group) {
        $group->post('', [UserController::class, 'login']);
    })->add(new AuthMiddleware());
};
