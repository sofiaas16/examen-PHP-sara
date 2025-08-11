<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\DomainException\User\UserAlreadyExistsException;
use App\Domain\Model\User\User;
use App\Domain\DomainException\User\UserNotFoundException;
use App\Domain\Repository\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ElloquentUserRepository implements UserRepository
{
    /**
     * {@inheritdoc}
     */
    public function findAll(?array $filters = null): array
    {
        $query = User::query();

        if ($filters) {
            $query->where($filters);
        }

        return $query->get()->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }
    }


    /**
     * {@inheritdoc}
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->findUserOfId($id);
        return $user->delete();
    }


    /**
     * {@inheritdoc}
     */
    public function createUser(array $data): User
    {
        $user = User::create($data);
        if (!$user) {
            throw new UserAlreadyExistsException();
        }
        return $user;
    }


    /**
     * {@inheritdoc}
     */
    public function updateUser(int $id, array $data): bool
    {
        $user = $this->findUserOfId($id);
        return $user->update($data);
    }
}
