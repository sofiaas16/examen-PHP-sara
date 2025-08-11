<?php

namespace App\UseCases;

use App\Domain\Models\User;
use App\Domain\Repositories\PlantasRepositoryInterface;

class GetAllPlantas{

    public function __construct(private PlantasRepositoryInterface $repo){}

    public function execute(): array {
        return $this->repo->getAll();
    }
}

