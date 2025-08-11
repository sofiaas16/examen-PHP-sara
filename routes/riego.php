<?php

use App\Controllers\RiegoController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->Riego('/Plantas', function ($group) {
        $Riego->get('', [RiegoController::class, 'index']);
        $Riego->get('/{id}', [RiegoController::class, 'show']);
        $Riego->post('', [RiegoController::class, 'store']);
        $Riego->put('/{id}', [RiegoController::class, 'update']);
        $Riego->delete('/{id}', [RiegoController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
