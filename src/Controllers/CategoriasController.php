<?php

namespace App\Controllers;

use App\Domain\Repository\CategoriasRepositoryInterface;
use App\UseCases\CreateCategorias;
use App\UseCases\GetAllCategorias;
use App\UseCases\GetByIDCategorias;
use App\UseCases\UpdateCategorias;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriasController
{
    public function __construct(private CategoriasRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllCategorias($this->repo);
        $campers = $useCase->execute();
        $response->getBody()->write(json_encode($campers));
        return $response;
    }
    public function show(Request $request, Response $response, array $args): Response
    {
        $useCase = new GetByIDCategorias($this->repo);
        $Categorias = $useCase->execute((int)$args['id']);
        if (!$Categorias) {
            $response->getBody()->write(json_encode(["error" => "Categorias no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($Categorias));
        return $response;
    }
    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $useCase = new CreateCategorias($this->repo);
        $Categorias = $useCase->execute($data);
    
        if ($Categorias) {
            $response->getBody()->write(json_encode([
                'message' => 'Categorias creado exitosamente',
                'Categorias' => $Categorias
            ]));
            return $response->withStatus(201);
        } else {
            $response->getBody()->write(json_encode([
                'message' => 'No se pudo crear el Categorias'
            ]));
            return $response->withStatus(400);
        }
    }
    

    public function update(Request $request, Response $response, array $args): Response
    {
        $documento = (int)$args['id'];
        $data = $request->getParsedBody();
        $useCase = new UpdateCategorias($this->repo);
        $success = $useCase->execute($documento, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Grupo no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        return $response->withStatus(204);
    }

    public function destroy(Request $request, Response $response, array $args): Response
    {
        $id = (int) ($args['id'] ?? 0);

        if ($id <= 0) {
            $response->getBody()->write(json_encode([
                'error' => 'ID invalido.'
            ]));
            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }

        $success = $this->repo->delete($id);

        if (!$success) {
            $response->getBody()->write(json_encode([
                'error' => 'Registro no encontrado o no se pudo eliminar.'
            ]));
            return $response
                ->withStatus(404)
                ->withHeader('Content-Type', 'application/json');
        }

        return $response->withStatus(204);
    }
}
