<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class ResponseLoggerMiddleware implements MiddlewareInterface
{
    private const LOG_FORMAT = '%d [%s] %s: %s';

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $code = $response->getStatusCode();
        if ($code >= 400 && $code < 600) {
            $this->logger->error(sprintf(
                self::LOG_FORMAT,
                $response->getStatusCode(),
                $request->getMethod(),
                (string) $request->getUri(),
                $response->getReasonPhrase()
            ), [
                'method' => $request->getMethod(),
                'url' => (string)$request->getUri(),
            ]);
        }
        return $response;
    }
}