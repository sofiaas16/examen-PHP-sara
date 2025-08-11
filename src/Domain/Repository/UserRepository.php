<?php

namespace App\Domain\Repository;

use App\Domain\Models\User;
use App\DTOs\UserDTO;

interface UserRepositoryInterface
{
    // POST
    public function create(UserDTO $dto): User;

    // GET
    public function getAll(): array;

    // GET
    public function getMe(int $id): User;

    // GET por ID
    public function getById(int $id): ?User;

    // PUT
    public function update(int $id, UserDTO $dto): bool;

    // DELETE
    public function delete(int $id): bool;
}
