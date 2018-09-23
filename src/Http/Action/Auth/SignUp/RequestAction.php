<?php

declare(strict_types=1);

namespace App\Http\Action\Auth\SignUp;

use App\Http\ValidationException;
use App\Http\Validator\Validator;
use App\Model\User\UseCase\SignUp\Request\Command;
use App\Model\User\UseCase\SignUp\Request\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Helper\UrlHelper;

class RequestAction implements RequestHandlerInterface
{
    private $handler;
    private $url;
    private $validator;

    public function __construct(Handler $handler, UrlHelper $url, Validator $validator)
    {
        $this->handler = $handler;
        $this->url = $url;
        $this->validator = $validator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);

        $command = new Command();

        $command->email = $body['email'] ?? '';
        $command->password = $body['password'] ?? '';

        if ($errors = $this->validator->validate($command)) {
            throw new ValidationException($errors);
        }

        $this->handler->handle($command);

        return new JsonResponse([
            'email' => $command->email,
            'links' => [
                [
                    'rel' => 'confirm',
                    'url' => $this->url->generate('auth.signup.confirm'),
                    'type' => 'POST',
                ],
            ],
        ], 201);
    }
}
