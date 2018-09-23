<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\User\Service;

use Psr\Container\ContainerInterface;

class RandConfirmTokenizerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $interval = $container->get('config')['auth']['signup_confirm_interval'];

        return new RandConfirmTokenizer(new \DateInterval($interval));
    }
}
