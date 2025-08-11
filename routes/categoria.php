<?php

use App\Controllers\CategoriasController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->categoria('/categoria', function ($categoria) {
        $categoria->get('', [CategoriasController::class, 'index']);
        $categoria->get('/{id}', [CategoriasController::class, 'show']);
        $categoria->post('', [CategoriasController::class, 'store']);
        $categoria->put('/{id}', [CategoriasController::class, 'update']);
        $categoria->delete('/{id}', [CategoriasController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
