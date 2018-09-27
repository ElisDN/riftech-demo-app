<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class RejectTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $lot->sendToModeration($date = new \DateTimeImmutable());

        $lot->reject($reason = 'Reason');

        self::assertTrue($lot->isDraft());
        self::assertNotNull($lot->getOnModerationDate());
        self::assertEquals($reason, $lot->getRejectReason());
    }
}
