<?php

use App\Controllers\PlantasController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->Plantas('/Plantas', function ($group) {
        $Plantas->get('', [PlantasController::class, 'index']);
        $Plantas->get('/{id}', [PlantasController::class, 'show']);
        $Plantas->post('', [PlantasController::class, 'store']);
        $Plantas->put('/{id}', [PlantasController::class, 'update']);
        $Plantas->delete('/{id}', [PlantasController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
