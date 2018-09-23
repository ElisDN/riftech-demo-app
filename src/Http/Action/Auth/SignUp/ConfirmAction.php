<?php

declare(strict_types=1);

namespace App\Http\Action\Auth\SignUp;

use App\Http\ValidationException;
use App\Http\Validator\Validator;
use App\Model\User\UseCase\SignUp\Confirm\Command;
use App\Model\User\UseCase\SignUp\Confirm\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ConfirmAction implements RequestHandlerInterface
{
    private $handler;
    private $validator;

    public function __construct(Handler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->deserialize($request);

        if ($errors = $this->validator->validate($command)) {
            throw new ValidationException($errors);
        }

        $this->handler->handle($command);

        return new JsonResponse([
            'links' => [
                [
                    'rel' => 'profile',
                    'url' => '/profile',
                    'type' => 'GET',
                ],
            ],
        ]);
    }

    private function deserialize(ServerRequestInterface $request): Command
    {
        $data = $request->getParsedBody();
        $command = new Command();
        $command->email = $data['email'] ?? '';
        $command->token = $data['token'] ?? '';
        return $command;
    }
}
