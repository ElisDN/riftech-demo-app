<?php

return [
    'dependencies' => [
        'factories' => [
            App\Console\Command\FixtureCommand::class => App\Infrastructure\Console\Command\FixtureCommandFactory::class,
        ],
    ],
    'console' => [
        'commands' => [
            App\Console\Command\FixtureCommand::class,
        ],
    ],
];
