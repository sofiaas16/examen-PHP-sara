<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\User\User;

interface UserRepository
{
    /**
     * @param ?array $filters
     * @return User[]
     */
    public function findAll(?array $filters = null): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    /**
     * @param int $id
     * @return bool
     * @throws UserNotFoundException
     */
    public function deleteUser(int $id): bool;

    /**
     * @param array $data
     * @return User
     * @throws UserNotFoundException
     */
    public function createUser(array $data): User;

    /**
     * @param array $data
     * @return bool
     * @throws UserNotFoundException
     */
    public function updateUser(int $id, array $data): bool;
}
