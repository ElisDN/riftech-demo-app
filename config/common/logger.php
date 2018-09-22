<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'factories'  => [
            Psr\Log\LoggerInterface::class => App\Infrastructure\LoggerFactory::class,
        ],
        'delegators' => [
            Zend\Stratigility\Middleware\ErrorHandler::class => [
                App\Infrastructure\Framework\Middleware\ErrorHandler\LoggingErrorListenerDelegatorFactory::class,
            ],
        ],
    ],

    'logger' => [
        'file' => 'var/log/application.log',
    ],
];
