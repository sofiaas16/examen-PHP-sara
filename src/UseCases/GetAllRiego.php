<?php

namespace App\UseCases;

use App\Domain\Models\User;
use App\Domain\Repositories\RiegoRepositoryInterface;

class GetAllRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}

    public function execute(): array {
        return $this->repo->getAll();
    }
}

