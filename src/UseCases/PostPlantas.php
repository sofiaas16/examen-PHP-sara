<?php

namespace App\UseCases;

use App\Domain\Models\Plantas;
use App\Domain\Repositories\PlantasRepositoryInterface;

class PostPlantas
{
    private PlantasRepositoryInterface $repo;

    public function __construct(PlantasRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(array $data): ?Plantas
    {
        return $this->repo->create($data);
    }
}
