<?php

declare(strict_types=1);

use App\Domain\Repository\UserRepository;
use App\Infrastructure\Persistence\User\ElloquentUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(ElloquentUserRepository::class),
    ]);
};
