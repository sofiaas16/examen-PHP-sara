<?php

namespace App\UseCases;

use App\Domain\Models\Riego;
use App\Domain\Repositories\RiegoRepositoryInterface;

class PostPlantas
{
    private RiegoRepositoryInterface $repo;

    public function __construct(RiegoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(array $data): ?Riego
    {
        return $this->repo->create($data);
    }
}
