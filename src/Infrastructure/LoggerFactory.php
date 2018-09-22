<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $log = new Logger('App');
        $log->pushHandler(new StreamHandler(
            $container->get('config')['logger']['file'],
            $container->get('config')['debug'] ? Logger::DEBUG : Logger::WARNING
        ));
        return $log;
    }
}
