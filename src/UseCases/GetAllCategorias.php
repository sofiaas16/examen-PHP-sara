<?php

namespace App\UseCases;

use App\Domain\Models\User;
use App\Domain\Repositories\CategoriasRepositoryInterface;

class GetAllCategorias{

    public function __construct(private CategoriasRepositoryInterface $repo){}

    public function execute(): array {
        return $this->repo->getAll();
    }
}

