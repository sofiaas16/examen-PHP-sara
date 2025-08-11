<?php

// Contenedor
use DI\Container;

//Factory Interface
use Psr\Http\Message\ResponseFactoryInterface;

// Usuario
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentUserRepository;
// Departamento
use App\Domain\Repositories\DepartamentoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentDepartamentoRepository;

// Grupo
use App\Domain\Repositories\GruposRepositoryInterface;
use App\Infrastructure\Repositories\EloquentGruposRepository;

//Obtentores
use App\Domain\Repositories\ObtentoresRepositoryInterface;
use App\Infrastructure\Repositories\EloquentObtentoresRepository;

//Imagenes
use App\Domain\Repositories\ImagenesRepositoryInterface;
use App\Infrastructure\Repositories\EloquentImagenRepository;

use App\Domain\Repositories\VariedadesRepositoryInterface;
use App\Infrastructure\Repositories\EloquentVariedadesRepository;

// Manejo de errores
use App\Handler\CustomErrorHandler;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\ErrorHandlerInterface;

$container = new Container();

$container->set(UserRepositoryInterface::class, function () {
    return new EloquentUserRepository();
});

$container->set(DepartamentoRepositoryInterface::class, function () {
    return new EloquentDepartamentoRepository();
});

$container->set(GruposRepositoryInterface::class, function () {
    return new EloquentGruposRepository();
});

$container->set(ObtentoresRepositoryInterface::class, function () {
    return new EloquentObtentoresRepository();
});

$container->set(ImagenesRepositoryInterface::class, function () {
    return new EloquentImagenRepository();
});

$container->set(VariedadesRepositoryInterface::class, function () {
    return new EloquentVariedadesRepository();
});

// Manejo de Errores
$container->set(ErrorHandlerInterface::class, function () use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});

return $container;
