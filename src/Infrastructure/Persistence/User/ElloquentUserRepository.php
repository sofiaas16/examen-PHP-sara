<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User;
use App\DTOs\UserDTO;

use App\Domain\Repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function getMe(int $id): User
    {
        return User::where('id', $id)->firstOrFail();
    }

    public function getAll(): array
    {
        return User::all()->toArray();
    }

    public function getById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function create(UserDTO $dto): User
    {
        $exists = User::where('email', $dto->email)->first();
    
        if ($exists) {
            return $exists;
        }
    
        return User::create($dto->toArray());
    }
    

    public function update(int $id, UserDTO $dto): bool
    {
        $user = $this->getById($id);
        return $user ? $user->update($dto->toArray()) : false;
    }


    public function delete(int $id): bool
    {
        $user = User::find($id);
        return $user ? $user->delete() : false;
    }
}
