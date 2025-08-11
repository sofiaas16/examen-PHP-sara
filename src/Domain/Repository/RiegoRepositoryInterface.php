<?php

namespace App\Domain\Repository;

use App\Domain\Models\riego;

interface RiegoRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?riego;
    public function create(array $data): riego;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
