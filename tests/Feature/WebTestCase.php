<?php

declare(strict_types=1);

namespace Test\Feature;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class WebTestCase extends TestCase
{
    protected function get(string $uri): ResponseInterface
    {
        return $this->method($uri, 'GET');
    }

    protected function method(string $uri, $method): ResponseInterface
    {
        return $this->request(
            (new ServerRequest())
                ->withUri(new Uri('http://test' . $uri))
                ->withMethod($method)
        );
    }

    protected function request(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->app()->handle($request);
        $response->getBody()->rewind();
        return $response;
    }

    private function app(): Application
    {
        /** @var \Psr\Container\ContainerInterface $container */
        $container = require 'config/container.php';
        $app = $container->get(Application::class);
        $factory = $container->get(MiddlewareFactory::class);
        (require 'config/pipeline.php')($app, $factory, $container);
        (require 'config/routes.php')($app, $factory, $container);
        return $app;
    }
}
