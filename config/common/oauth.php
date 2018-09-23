<?php

declare(strict_types=1);

use League\OAuth2\Server;
use App\Infrastructure\Model\OAuth as Infrastructure;

return [
    'dependencies' => [
        'factories' => [
            Server\AuthorizationServer::class => \App\Infrastructure\OAuth\AuthorizationServerFactory::class,
            Server\ResourceServer::class => \App\Infrastructure\OAuth\ResourceServerFactory::class,
            Infrastructure\Entity\ClientRepository::class => Infrastructure\Entity\ClientRepositoryFactory::class,
        ],
        'aliases' => [
            Server\Repositories\AccessTokenRepositoryInterface::class => Infrastructure\Entity\AccessTokenRepository::class,
            Server\Repositories\AuthCodeRepositoryInterface::class => Infrastructure\Entity\AuthCodeRepository::class,
            Server\Repositories\ClientRepositoryInterface::class => Infrastructure\Entity\ClientRepository::class,
            Server\Repositories\RefreshTokenRepositoryInterface::class => Infrastructure\Entity\RefreshTokenRepository::class,
            Server\Repositories\ScopeRepositoryInterface::class => Infrastructure\Entity\ScopeRepository::class,
            Server\Repositories\UserRepositoryInterface::class => Infrastructure\Entity\UserRepository::class,
        ],
    ],

    'oauth' => [
        'public_key_path' => dirname(__DIR__, 2) . '/' . getenv('OAUTH_PUBLIC_KEY_PATH'),
        'private_key_path' => dirname(__DIR__, 2) . '/' . getenv('OAUTH_PRIVATE_KEY_PATH'),
        'encryption_key' => getenv('OAUTH_ENCRYPTION_KEY'),
        'clients' => [
            'app' => [
                'secret'          => null,
                'name'            => 'App',
                'redirect_uri'    => null,
                'is_confidential' => false,
            ],
        ],
    ],
];