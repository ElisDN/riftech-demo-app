<?php

declare(strict_types=1);

namespace Test\Feature\Auth\SignUp;

use App\Model\User\Entity\User\ConfirmToken;
use App\Model\User\Entity\User\Email;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Test\Builder\User\UserBuilder;

class ConfirmFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $user = (new UserBuilder())
            ->withDate($now = new \DateTimeImmutable())
            ->withEmail(new Email('confirm@example.com'))
            ->withConfirmToken(new ConfirmToken('token', $now->modify('+1 day')))
            ->build();

        $manager->persist($user);

        $expired = (new UserBuilder())
            ->withDate($now = new \DateTimeImmutable())
            ->withEmail(new Email('expired@example.com'))
            ->withConfirmToken(new ConfirmToken('token', $now->modify('-1 day')))
            ->build();

        $manager->persist($expired);

        $manager->flush();
    }
}
