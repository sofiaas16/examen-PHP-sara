<?php

namespace App\Application\UseCase\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use App\Application\UseCase\Contracts\ActionUseCase;
use App\Domain\Repository\UserRepository;

class DeleteUserUseCase implements ActionUseCase
{
    public function __construct(private readonly UserRepository $repository) {}

    /**
     * @param ?ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null)
    {
        return $this->repository->deleteUser($dto->toArray()['id']);
    }
}
