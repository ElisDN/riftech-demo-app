<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'var/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Zend\Expressive\Router\FastRouteRouter\ConfigProvider::class,
    \Zend\HttpHandlerRunner\ConfigProvider::class,
    new ArrayProvider($cacheConfig),
    \Zend\Expressive\Helper\ConfigProvider::class,
    \Zend\Expressive\ConfigProvider::class,
    \Zend\Expressive\Router\ConfigProvider::class,
    new PhpFileProvider(realpath(__DIR__) . '/common/*.php'),
    new PhpFileProvider(realpath(__DIR__) . '/' . (getenv('APP_ENV') ?: 'prod') . '/*.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
