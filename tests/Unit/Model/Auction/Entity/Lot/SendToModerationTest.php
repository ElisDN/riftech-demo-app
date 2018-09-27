<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class SendToModerationTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        self::assertTrue($lot->isDraft());
        self::assertFalse($lot->isOnModeration());
        self::assertNull($lot->getOnModerationDate());

        $lot->sendToModeration($date = new \DateTimeImmutable());

        self::assertFalse($lot->isDraft());
        self::assertTrue($lot->isOnModeration());
        self::assertEquals($date, $lot->getOnModerationDate());
    }
}
