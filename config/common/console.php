<?php

return [
    'dependencies' => [
        'factories' => [
            Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand::class => App\Infrastructure\Doctrine\Command\DiffCommandFactory::class,
        ],
    ],
    'console' => [
        'commands' => [
            Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\UpToDateCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand::class,
            Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand::class,
        ],
    ],
];
