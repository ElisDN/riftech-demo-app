<?php

declare(strict_types=1);

use App\Infrastructure\Model\User as UserInfrastructure;
use App\Model\User as UserModel;

return [
    'dependencies' => [
        'aliases' => [
            App\Model\Flusher::class => App\Infrastructure\Model\Service\DoctrineFlusher::class,

            UserModel\Service\PasswordHasher::class => UserInfrastructure\Service\BCryptPasswordHasher::class,
            UserModel\Entity\User\UserRepository::class => UserInfrastructure\Entity\DoctrineUserRepository::class,
        ],
        'factories'  => [
            UserModel\Service\ConfirmTokenizer::class => UserInfrastructure\Service\RandConfirmTokenizerFactory::class
        ],
    ],

    'auth' => [
        'signup_confirm_interval' => 'PT5M',
    ],
];
