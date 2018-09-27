<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Member;

use App\Model\Auction\Entity\Member\Email;
use App\Model\Auction\Entity\Member\Name;
use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\MemberBuilder;

class EditTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = (new MemberBuilder())->build();

        $member->edit(
            $email = new Email('member@site.com'),
            $name = new Name('Last', 'First', '')
        );

        self::assertEquals($email, $member->getEmail());
        self::assertEquals($name, $member->getName());
    }
}
