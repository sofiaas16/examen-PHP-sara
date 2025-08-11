<?php

namespace App\Domain\Repository;

use App\Domain\Models\Categorias;

interface CategoriasRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?Categorias;
    public function create(array $data): Categorias;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
