<?php

namespace App\UseCases;

use App\Domain\Repositories\RiegoRepositoryInterface;

class UpdateRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        return $this->repo->update($id,$data);
    }
}