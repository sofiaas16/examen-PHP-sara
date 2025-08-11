<?php

declare(strict_types=1);

namespace App\Application\Controllers\User;

use App\Application\Dtos\User\FilterUserDto;
use App\Application\Dtos\User\FindUserDto;
use App\Application\Dtos\User\PatchUserDto;
use App\Application\Dtos\User\UserDto;
use App\Application\Http\Traits\ApiResponseTrait;
use App\Application\UseCase\User\CreateUserUseCase;
use App\Application\UseCase\User\DeleteUserUseCase;
use App\Application\UseCase\User\FindUserUseCase;
use App\Application\UseCase\User\GetAllUserUseCase;
use App\Application\UseCase\User\UpdateUserUseCase;
use App\Domain\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    use ApiResponseTrait;

    public function __construct(private readonly UserRepository $userRepository) {}

    /**
     * @return mixed
     */
    public function index(Request $request, Response $response)
    {
        $dto = new FilterUserDto($request->getQueryParams());
        $useCase = new GetAllUserUseCase($this->userRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function findById(Request $request, Response $response, array $args)
    {
        $dto = new FindUserDto($args);
        $useCase = new FindUserUseCase($this->userRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        $dto = new UserDto($request->getParsedBody());
        $useCase = new CreateUserUseCase($this->userRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response, array $args)
    {
        $dto = new PatchUserDto(array_merge($request->getParsedBody(), $args));
        $useCase = new UpdateUserUseCase($this->userRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response, array $args)
    {
        $dto = new FindUserDto($args);
        $useCase = new DeleteUserUseCase($this->userRepository);
        return $this->successResponse($response, $useCase($dto));
    }
}
