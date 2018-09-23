<?php

declare(strict_types=1);

namespace App\Infrastructure\OAuth;

use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\ResourceServer;
use Psr\Container\ContainerInterface;

class ResourceServerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['oauth'];

        $accessTokenRepository = $container->get(AccessTokenRepositoryInterface::class);

        return new ResourceServer(
            $accessTokenRepository,
            new CryptKey($config['public_key_path'], null, false)
        );
    }
}
