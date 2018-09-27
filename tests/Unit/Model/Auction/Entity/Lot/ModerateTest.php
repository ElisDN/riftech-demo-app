<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class ModerateTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $lot->sendToModeration(new \DateTimeImmutable('-1 day'));

        self::assertTrue($lot->isOnModeration());
        self::assertNotNull($lot->getOnModerationDate());
        self::assertFalse($lot->isActive());

        $lot->moderate($date = new \DateTimeImmutable());

        self::assertFalse($lot->isOnModeration());
        self::assertNull($lot->getOnModerationDate());
        self::assertTrue($lot->isActive());

        self::assertEquals($date, $lot->getPublishDate());
    }

    public function testIsNotOnModeration(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $this->expectExceptionMessage('Lot is not on moderation.');

        $lot->moderate(new \DateTimeImmutable());
    }
}
