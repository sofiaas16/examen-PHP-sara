<?php

declare(strict_types=1);

namespace App\Domain\DomainException\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'El usuario que esta buscando no existe.';
}
