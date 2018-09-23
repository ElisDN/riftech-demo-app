<?php

declare(strict_types=1);

use App\Http\Action;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

    $app->get('/', Action\HomeAction::class, 'home');

    $app->post('/auth/signup', Action\Auth\SignUp\RequestAction::class, 'auth.signup');
    $app->post('/auth/signup/confirm', Action\Auth\SignUp\ConfirmAction::class, 'auth.signup.confirm');

};
