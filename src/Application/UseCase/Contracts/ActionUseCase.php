<?php

namespace App\Application\UseCase\Contracts;

use App\Application\Dtos\Contracts\ArraySerializableDto;

interface ActionUseCase
{
    /**
     * @param ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null);
}
