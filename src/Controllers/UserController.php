<?php

namespace App\Controllers;

use App\Domain\Repositories\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DTOs\UserDTO;
use App\UseCases\GetAllUsers;
use App\UseCases\GetByID;
use App\UseCases\UpdateUsers;

class UserController
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function login(Request $request, Response $response): Response
    {
        $useCase = new GetByID($this->repo);
        $users = $useCase->execute($request->getAttribute('user')->id);
        $response->getBody()->write(json_encode($users));
        return $response;
    }

    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllUsers($this->repo);
        $users = $useCase->execute();
        $response->getBody()->write(json_encode($users));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $useCase = new GetByID($this->repo);
        $users = $useCase->execute((int)$args['id']);
        if (!$users) {
            $response->getBody()->write(json_encode(["error" => "Usario no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($users));
        return $response;
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $userId = (int)$args['id'];
        $data = $request->getParsedBody();

        try {
            $dto = new UserDTO(
                nombre: $data['nombre'] ?? '',
                email: $data['email'] ?? '',
                password: $data['password'] ?? '',
                rol: $data['rol'] ?? 'user'
            );
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withStatus(400);
        }

        $useCase = new UpdateUsers($this->repo);
        $success = $useCase->execute($userId, $dto);

        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Usuario no registrado en la plataforma"]));
            return $response->withStatus(404);
        }

        return $response->withStatus(204);
    }


    public function destroy(Request $request, Response $response, array $args): Response
    {
        $userId = (int) ($args['id'] ?? 0);

        if ($userId <= 0) {
            $response->getBody()->write(json_encode(['error' => 'ID de usuario no valido']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $success = $this->repo->delete($userId);

        if (!$success) {
            $response->getBody()->write(json_encode(['error' => 'Usuario no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        return $response->withStatus(204); // 204 No Content
    }

    public function createUser(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();
        //TODO: Se debe implementar con Caso de USOOOOOOO!
        $dto = new UserDTO(
            nombre: $data['nombre'] ?? '',
            email: $data['email'] ?? '',
            password: $data['password'] ?? '',
            rol: 'user',
        );

        $user = $this->repo->create($dto);

        $response->getBody()->write(json_encode($user));

        return $response->withStatus(201);
    }

    public function createAdmin(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        if (empty($data['password'])) {
            $response->getBody()->write(json_encode(['error' => 'Password is required']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $dto = new UserDTO($data['nombre'], $data['email'], $data['password'], 'admin');
            $user = $this->repo->create($dto);

            $response->getBody()->write(json_encode($user));
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withStatus(422)->withHeader('Content-Type', 'application/json');
        }
    }
}
