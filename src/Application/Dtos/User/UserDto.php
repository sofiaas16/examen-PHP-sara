<?php

declare(strict_types=1);

namespace App\Application\Dtos\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserDto implements ArraySerializableDto
{

    /**
     * @param array $args
     */
    public function __construct(private readonly array $args)
    {
        $this->validate();
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validate()
    {
        try {
            v::stringType()->length(min: 2, max: 50)->setName('name')->assert($this->args['name']);
            v::email()->setName('email')->assert($this->args['email']);
            v::stringType()->length(min: 8, max: 100)
                ->regex('/[!@#$%^&*()\-_=+{};:,<.>]/')->regex('/[0-9]/')
                ->setName('password')->assert($this->args['password']);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => htmlspecialchars($this->args['name']),
            'email' => htmlspecialchars($this->args['email']),
            'password' => password_hash($this->args['password'], PASSWORD_DEFAULT)
        ];
    }
}
