<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\OAuth\Entity;

use Psr\Container\ContainerInterface;

class ClientRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['oauth'];

        return new ClientRepository($config['clients']);
    }
}
