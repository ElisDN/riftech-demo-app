<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'aliases' => [],
        'invokables' => [],
        'abstract_factories'  => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories'  => [
            Symfony\Component\Validator\Validator\ValidatorInterface::class => App\Infrastructure\ValidatorFactory::class,
        ],
    ],
];
