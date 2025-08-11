<?php

namespace App\UseCases;

use App\Domain\Models\Categorias;
use App\Domain\Repositories\CategoriasRepositoryInterfacce;

class PostCategorias
{
    private CategoriasRepositoryInterfacce $repo;

    public function __construct(CategoriasRepositoryInterfacce $repo)
    {
        $this->repo = $repo;
    }

    public function execute(array $data): ?Categorias
    {
        return $this->repo->create($data);
    }
}
