<?php

declare(strict_types=1);

use App\Infrastructure\Model\User as UserInfrastructure;
use App\Infrastructure\Model\Auction as AuctionInfrastructure;
use App\Model\User as UserModel;
use App\Model\Auction as AuctionModel;

return [
    'dependencies' => [
        'aliases' => [
            App\Model\Flusher::class => App\Infrastructure\Model\Service\DoctrineFlusher::class,

            UserModel\Service\PasswordHasher::class => UserInfrastructure\Service\BCryptPasswordHasher::class,
            UserModel\Entity\User\UserRepository::class => UserInfrastructure\Entity\DoctrineUserRepository::class,

            AuctionModel\Entity\Member\MemberRepository::class => AuctionInfrastructure\Entity\DoctrineMemberRepository::class,
            AuctionModel\Entity\Lot\LotRepository::class => AuctionInfrastructure\Entity\DoctrineLotRepository::class,
        ],
        'factories'  => [
            UserModel\Service\ConfirmTokenizer::class => UserInfrastructure\Service\RandConfirmTokenizerFactory::class
        ],
    ],

    'auth' => [
        'signup_confirm_interval' => 'PT5M',
    ],
];
