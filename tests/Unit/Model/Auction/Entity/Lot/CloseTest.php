<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\Price;
use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class CloseTest extends TestCase
{
    public function testWithoutBids(): void
    {
        $lot = $this->buildActiveLot(new Price(100, null));

        $lot->close($date = new \DateTimeImmutable());

        self::assertFalse($lot->isActive());
        self::assertNull($lot->getOnModerationDate());
        self::assertTrue($lot->isClosed());
        self::assertEquals($date, $lot->getCloseDate());

        self::assertNull($lot->getWinner());
    }

    public function testWithWinner(): void
    {
        $lot = $this->buildActiveLot(new Price(100, null));

        $member1 = (new MemberBuilder())->build();
        $lot->makeBid($member1, 200, new \DateTimeImmutable());

        $member2 = (new MemberBuilder())->build();
        $lot->makeBid($member2, 250, new \DateTimeImmutable());

        $lot->close($date = new \DateTimeImmutable());

        self::assertFalse($lot->isActive());
        self::assertNull($lot->getOnModerationDate());
        self::assertTrue($lot->isClosed());
        self::assertEquals($date, $lot->getCloseDate());

        self::assertNotNull($lot->getWinner());
        self::assertEquals($member2, $lot->getWinner()->getMember());
    }

    public function testNotActive(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $this->expectExceptionMessage('Lot is not active.');

        $lot->close($date = new \DateTimeImmutable());
    }

    private function buildActiveLot(Price $price): Lot
    {
        $member = (new MemberBuilder())->build();
        return (new LotBuilder($member))
            ->withPrice($price)
            ->active()
            ->build();
    }
}
