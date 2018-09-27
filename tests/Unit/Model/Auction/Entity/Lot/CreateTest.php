<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Lot\Content;
use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\Price;
use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\MemberBuilder;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $member = (new MemberBuilder())->build();

        $lot = new Lot(
            $id = LotId::next(),
            $member,
            $date = new \DateTimeImmutable(),
            $content = new Content(
                'Name',
                'Description'
            ),
            $price = new Price(1000, 35000)
        );

        self::assertEquals($id, $lot->getId());
        self::assertEquals($member, $lot->getMember());
        self::assertEquals($date, $lot->getCreateDate());
        self::assertEquals($content, $lot->getContent());
        self::assertEquals($price, $lot->getPrice());
    }
}
