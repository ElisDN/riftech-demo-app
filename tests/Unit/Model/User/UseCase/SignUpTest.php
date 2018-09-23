<?php

declare(strict_types=1);

namespace Test\Unit\Model\User\UseCase;

use App\Model\User\Entity\User\ConfirmToken;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserId;
use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(
            $id = UserId::next(),
            $date = new \DateTimeImmutable(),
            $email = new Email('mail@example.com'),
            $hash = 'hash',
            $token = new ConfirmToken('token', new \DateTimeImmutable('+1 day'))
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($token, $user->getConfirmToken());
    }
}