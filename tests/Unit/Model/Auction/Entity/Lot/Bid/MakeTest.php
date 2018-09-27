<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot\Bid;

use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\Price;
use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class MakeTest extends TestCase
{
    public function testWithoutBids(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))
            ->withPrice($price = new Price(100, null))
            ->build();

        self::assertEquals($price->getStart(), $lot->getCurrentPrice());
        self::assertNull($lot->getLastBidDate());
    }

    public function testDraft(): void
    {
        $owner = (new MemberBuilder())->build();
        $lot = (new LotBuilder($owner))
            ->withPrice(new Price(100, null))
            ->build();

        $this->expectExceptionMessage('Lot is not active.');

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, 500, new \DateTimeImmutable());
    }

    public function testByOwner(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))
            ->withPrice(new Price(100, null))
            ->active()
            ->build();

        $this->expectExceptionMessage('Unable to make bid by owner.');

        $lot->makeBid($member, 500, new \DateTimeImmutable());
    }

    public function testFirstBid(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, $price = 500, $date = new \DateTimeImmutable());

        self::assertEquals($price, $lot->getCurrentPrice());
        self::assertEquals($date, $lot->getLastBidDate());
    }

    public function testSecondBid(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $member1 = (new MemberBuilder())->build();
        $lot->makeBid($member1, 500, new \DateTimeImmutable());

        $member2 = (new MemberBuilder())->build();
        $lot->makeBid($member2, $price = 550, $date = new \DateTimeImmutable('+1 day'));

        self::assertEquals($price, $lot->getCurrentPrice());
        self::assertEquals($date, $lot->getLastBidDate());
    }

    public function testLessThanStartPrice(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $this->expectExceptionMessage('Price is too small.');

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, $price->getStart() - 50, new \DateTimeImmutable());
    }

    public function testEqualsToStartPrice(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $this->expectExceptionMessage('Price is too small.');

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, $price->getStart(), new \DateTimeImmutable());
    }

    public function testLessThanLastBidPrice(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, 200, new \DateTimeImmutable());

        $this->expectExceptionMessage('Price is too small.');

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, 180, new \DateTimeImmutable());
    }

    public function testEqualsToLastBidPrice(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, $price = 200, new \DateTimeImmutable());

        $this->expectExceptionMessage('Price is too small.');

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, $price, new \DateTimeImmutable());
    }

    public function testAlreadyPlaced(): void
    {
        $price = new Price(100, null);
        $lot = $this->buildActiveLot($price);

        $member = (new MemberBuilder())->build();
        $lot->makeBid($member, 150, new \DateTimeImmutable());

        $this->expectExceptionMessage('Bid is already placed.');

        $lot->makeBid($member, 200, new \DateTimeImmutable());
    }

    private function buildActiveLot($price): Lot
    {
        $owner = (new MemberBuilder())->build();
        return (new LotBuilder($owner))
            ->withPrice($price)
            ->active()
            ->build();
    }
}
