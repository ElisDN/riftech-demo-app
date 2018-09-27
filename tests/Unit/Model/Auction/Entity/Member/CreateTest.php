<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Member;

use App\Model\Auction\Entity\Member\Email;
use App\Model\Auction\Entity\Member\Member;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\Name;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = new Member(
            $id = MemberId::next(),
            $email = new Email('member@site.com'),
            $name = new Name('Last', 'First', '')
        );

        self::assertEquals($id, $member->getId());
        self::assertEquals($email, $member->getEmail());
        self::assertEquals($name, $member->getName());
    }
}
