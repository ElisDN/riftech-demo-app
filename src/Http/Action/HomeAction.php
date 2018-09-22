<?php

declare(strict_types=1);

namespace App\Http\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Helper\UrlHelper;

class HomeAction implements RequestHandlerInterface
{
    private $url;

    public function __construct(UrlHelper $url)
    {
        $this->url = $url;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'name' => 'Api',
            'links' => [
                [
                    'rel' => 'self',
                    'url' => $this->url->generate('home'),
                    'type' => 'GET',
                ],
            ],
        ]);
    }
}
