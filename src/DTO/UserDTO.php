<?php

namespace App\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserDTO
{
    private string $password;

    public function __construct(
        public readonly string $nombre,
        public readonly string $email,
        string $password,
        public readonly string $rol = 'user'
    ) {
        $this->validate($nombre, $email, $password, $rol);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    private function validate(string $nombre, string $email, string $password, string $rol): void
    {
        $nombre = trim($nombre);
        $email = trim($email);
        $rol = trim($rol);

        try {
            v::stringType()->length(2, 50)->setName('Nombre')->assert($nombre);
            v::email()->setTemplate('{{name}} no es un correo valido')->setName('email')->assert($email);
            v::stringType()->length(8, 100)
                ->regex('/[!@#$%^&*()\-_=+{};:,<.>]/')
                ->regex('/[0-9]/')
                ->setName('Contraseña')->assert($password);
            v::in(['user', 'admin'])->setName('Rol')->assert($rol);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }



    public function toArray(): array
    {
        return [
            'nombre'   => $this->nombre,
            'email'    => $this->email,
            'password' => $this->password,
            'rol'      => $this->rol,
        ];
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
