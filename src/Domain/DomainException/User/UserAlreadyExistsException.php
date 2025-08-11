<?php

declare(strict_types=1);

namespace App\Domain\DomainException\User;

use App\Domain\DomainException\DomainRecordConflictException;

class UserAlreadyExistsException extends DomainRecordConflictException
{
    public $message = 'El correo electrónico o nombre de usuario ya se encuentra registrado.';
}
