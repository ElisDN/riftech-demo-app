<?php

use App\Infrastructure\Doctrine\Type;

return [
    'dependencies' => [
        'factories'  => [
            Doctrine\ORM\EntityManagerInterface::class => ContainerInteropDoctrine\EntityManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'url' => getenv('DATABASE_URL'),
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'result_cache' => 'filesystem',
                'metadata_cache' => 'filesystem',
                'query_cache' => 'filesystem',
                'hydration_cache' => 'filesystem',
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'App\Model\User\Entity' => 'user_entities',
                    'App\Model\OAuth\Entity' => 'oauth_entities',
                    'App\Model\Auction\Entity' => 'auction_entities',
                ],
            ],
            'user_entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'filesystem',
                'paths' => ['src/Model/User/Entity'],
            ],
            'oauth_entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'filesystem',
                'paths' => ['src/Model/OAuth/Entity'],
            ],
            'auction_entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'filesystem',
                'paths' => ['src/Model/Auction/Entity'],
            ],
        ],
        'types' => [
            Type\User\UserIdType::NAME => Type\User\UserIdType::class,
            Type\User\EmailType::NAME => Type\User\EmailType::class,
            Type\OAuth\ClientType::NAME => Type\OAuth\ClientType::class,
            Type\OAuth\ScopesType::NAME => Type\OAuth\ScopesType::class,
            Type\Auction\LotIdType::NAME => Type\Auction\LotIdType::class,
            Type\Auction\MemberIdType::NAME => Type\Auction\MemberIdType::class,
            Type\Auction\MemberEmailType::NAME => Type\Auction\MemberEmailType::class,
        ],
        'cache' => [
            'filesystem' => [
                'class' => Doctrine\Common\Cache\FilesystemCache::class,
                'directory' => 'data/cache/doctrine',
            ],
        ],
    ],
];
