<?php

namespace App\Application\UseCase\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use App\Application\UseCase\Contracts\ActionUseCase;
use App\Domain\Repository\UserRepository;

class FindUserUseCase implements ActionUseCase
{
    public function __construct(private readonly UserRepository $repository) {}

    /**
     * @param ?ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null)
    {
        return $this->repository->findUserOfId($dto->toArray()['id']);
    }
}
