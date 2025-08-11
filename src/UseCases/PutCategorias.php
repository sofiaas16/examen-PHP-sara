<?php

namespace App\UseCases;

use App\Domain\Repositories\CategoriasRepositoryInterface;

class UpdateCategorias{

    public function __construct(private CategoriasRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        return $this->repo->update($id,$data);
    }
}