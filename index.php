<?php

require_once "vendor/autoload.php";

use App\Infrastructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Interfaces\ErrorHandlerInterface;

//Variables de .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load(); //$_ENV[...]

//Se carga el Container de PHP-DI
$container = require_once 'bootstrap/container.php';

//Asignamos a Slim el contendor
AppFactory::setContainer($container);

//Iniciar la conexion con la DB
Connection::init();

$app = AppFactory::create();

//Inyectamos ResponseFactory que Necesita nuestro CustomErrorHandler
$container->set(ResponseFactoryInterface::class, $app->getResponseFactory());

//Definir quien va a manejar los erroress.....

$errorHanlder = $app->addErrorMiddleware(true, true, true);
$errorHanlder->setDefaultErrorHandler($container->get(ErrorHandlerInterface::class));

$app->addRoutingMiddleware();

//Configurar CORS
$app->add(function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($app): ResponseInterface {
    if ($request->getMethod() === 'OPTIONS') {
        $response = $app->getResponseFactory()->createResponse();
    } else {
        $response = $handler->handle($request);
    }

    $response = $response
        ->withHeader('Access-Control-Allow-Credentials', 'true')
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->withHeader('Pragma', 'no-cache');

    if (ob_get_contents()) {
        ob_clean();
    }

    return $response;
});

//Ejecutando los scripts de 
//public/
(require_once 'public/index.php')($app);
//routes/
(require_once 'routes/plantas.php')($app);
(require_once 'routes/categoria.php')($app);
(require_once 'routes/grupos.php')($app);
(require_once 'routes/obtentores.php')($app);
(require_once 'routes/imagenes.php')($app);
(require_once 'routes/variedades.php')($app);
$app->run();
