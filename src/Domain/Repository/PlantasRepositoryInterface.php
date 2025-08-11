<?php

namespace App\Domain\Repository;

use App\Domain\Models\Plantas;

interface PlantasRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?Plantas;
    public function create(array $data): Plantas;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
