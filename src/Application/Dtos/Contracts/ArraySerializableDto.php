<?php

namespace App\Application\Dtos\Contracts;

interface ArraySerializableDto
{

    /**
     * @return array
     */
    public function toArray(): array;
}
