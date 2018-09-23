<?php

declare(strict_types=1);

namespace App\Infrastructure\OAuth;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Psr\Container\ContainerInterface;

class AuthorizationServerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['oauth'];

        $clientRepository = $container->get(ClientRepositoryInterface::class);
        $scopeRepository = $container->get(ScopeRepositoryInterface::class);
        $accessTokenRepository = $container->get(AccessTokenRepositoryInterface::class);
        $authCodeRepository = $container->get(AuthCodeRepositoryInterface::class);
        $refreshTokenRepository = $container->get(RefreshTokenRepositoryInterface::class);
        $userRepository = $container->get(UserRepositoryInterface::class);

        $server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            new CryptKey($config['private_key_path'], null, false),
            $config['encryption_key']
        );

        $grant = new AuthCodeGrant($authCodeRepository, $refreshTokenRepository, new \DateInterval('PT10M'));
        $server->enableGrantType($grant, new \DateInterval('PT1H'));

        $server->enableGrantType(new ClientCredentialsGrant(), new \DateInterval('PT1H'));

        $server->enableGrantType(new ImplicitGrant(new \DateInterval('PT1H')));

        $grant = new PasswordGrant($userRepository, $refreshTokenRepository);
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $server->enableGrantType($grant, new \DateInterval('PT1H'));

        $grant = new RefreshTokenGrant($refreshTokenRepository);
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $server->enableGrantType($grant, new \DateInterval('PT1H'));

        return $server;
    }
}
